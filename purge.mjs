import { PurgeCSS } from 'purgecss';
import { readFileSync, writeFileSync, statSync } from 'fs';
import { fileURLToPath } from 'url';
import { dirname, join } from 'path';

const __dirname = dirname(fileURLToPath(import.meta.url));

const content = [
  { raw: '', extension: 'html' }, // placeholder
];

// Collect all PHP and JS file contents as raw strings
import { readdirSync } from 'fs';

function walkDir(dir, ext) {
  let results = [];
  try {
    const list = readdirSync(dir, { withFileTypes: true });
    for (const f of list) {
      const full = join(dir, f.name);
      if (f.isDirectory()) results = results.concat(walkDir(full, ext));
      else if (ext.some(e => f.name.endsWith(e))) results.push(full);
    }
  } catch {}
  return results;
}

const phpFiles = walkDir(join(__dirname, 'application/modules'), ['.php']);
const jsFiles  = walkDir(join(__dirname, 'assets/js'), ['.js']);

const allContent = [...phpFiles, ...jsFiles].map(f => ({
  raw: readFileSync(f, 'utf8'),
  extension: f.endsWith('.js') ? 'js' : 'html',
}));

const safelist = {
  standard: ['active','show','hide','fade','in','out','open','close','disabled','loading','error','success','visible','hidden','collapsed','collapsing','modal-open','overflow-hidden'],
  patterns: [
    /^col-/,/^row/,/^d-/,/^flex-/,/^align-/,/^justify-/,
    /^m[tblrxy]?-/,/^p[tblrxy]?-/,/^g[xy]?-/,/^gap-/,
    /^text-/,/^bg-/,/^border/,/^rounded/,/^w-/,/^h-/,
    /^fs-/,/^fw-/,/^lh-/,/^z-/,/^position-/,/^overflow-/,
    /^modal/,/^offcanvas/,/^dropdown/,/^collapse/,/^accordion/,
    /^nav/,/^navbar/,/^btn/,/^form-/,/^input-/,/^alert/,
    /^badge/,/^list-/,/^table/,/^card/,/^carousel/,
    /^tooltip/,/^popover/,/^spinner/,/^progress/,/^toast/,
    /^placeholder/,/^visually-/,/^sr-/,
    /^aos-/,/^swiper/,/^f-/,/^fancybox/,/^is-/,/^has-/,
    /^animate/,/^tab-/,/^ft-/,/^cc-/,/^cursor/,/^qm-/,
    /^header/,/^footer/,/^hero/,/^section/,/^counter/,
    /^testi/,/^pkg/,/^tour/,/^destination/,/^insta/,
    /^image/,/^media/,/^button/,/^scroll/,/^drawer/,/^sticky/,
    /^color-scheme/,/^home-page/,/^new-/,
  ],
};

const cssFiles = ['assets/css/style.css', 'assets/css/vendor.css'];

for (const cssFile of cssFiles) {
  const cssPath = join(__dirname, cssFile);
  const before = statSync(cssPath).size;

  const result = await new PurgeCSS().purge({
    content: allContent,
    css: [{ raw: readFileSync(cssPath, 'utf8') }],
    safelist,
    variables: true,
    keyframes: false,
  });

  const purged = result[0].css;
  writeFileSync(cssPath, purged, 'utf8');
  const after = Buffer.byteLength(purged, 'utf8');
  console.log(`${cssFile}: ${Math.round(before/1024)}KB → ${Math.round(after/1024)}KB (saved ${Math.round((before-after)/1024)}KB)`);
}
