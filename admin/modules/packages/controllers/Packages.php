<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
class Packages extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('mdl_packages');
        $this->ensure_categories_table();
        $this->ensure_table();
        $this->ensure_large_text_columns();
    }

    // ── Category management ──────────────────────────────────────────

    private function ensure_categories_table()
    {
        if (!$this->db->table_exists('categories')) {
            $this->load->dbforge();
            $this->dbforge->add_field(array(
                'cat_id'     => array('type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE),
                'name'       => array('type' => 'VARCHAR', 'constraint' => 100),
                'slug'       => array('type' => 'VARCHAR', 'constraint' => 100),
                'sort_order' => array('type' => 'INT', 'constraint' => 11, 'default' => 0),
            ));
            $this->dbforge->add_key('cat_id', TRUE);
            $this->dbforge->create_table('categories', TRUE);

            $this->db->insert_batch('categories', array(
                array('name' => 'Group Tour',     'slug' => 'group-tour',     'sort_order' => 1),
                array('name' => 'Family Tour',    'slug' => 'family-tour',    'sort_order' => 2),
                array('name' => 'Honeymoon Tour', 'slug' => 'honeymoon-tour', 'sort_order' => 3),
                array('name' => 'Luxury Tour',    'slug' => 'luxury-tour',    'sort_order' => 4),
            ));

            // Migrate old short-key values in packages table to full slugs
            if ($this->db->table_exists('packages')) {
                foreach (array('group'=>'group-tour','family'=>'family-tour','honeymoon'=>'honeymoon-tour','luxury'=>'luxury-tour') as $old => $new) {
                    $this->db->where('category', $old);
                    $this->db->update('packages', array('category' => $new, 'category_slug' => $new));
                }
            }
        }
    }

    function get_categories()
    {
        $rows = $this->db->order_by('sort_order', 'asc')->get('categories')->result_array();
        $this->output->set_content_type('application/json')->set_output(json_encode($rows));
    }

    function save_category()
    {
        $name = trim($this->input->post('name'));
        if (empty($name)) { echo json_encode(array('error' => 'Name is required')); return; }

        $slug = $this->make_category_slug($name);

        $this->db->where('slug', $slug);
        if ($this->db->count_all_results('categories') > 0) {
            echo json_encode(array('error' => 'Category already exists')); return;
        }

        $sort = (int)$this->db->count_all('categories') + 1;
        $this->db->insert('categories', array('name' => $name, 'slug' => $slug, 'sort_order' => $sort));
        echo '1';
    }

    function delete_category()
    {
        $id = (int)$this->input->get('id');
        if (!$id) { echo '0'; return; }
        $this->db->where('cat_id', $id)->delete('categories');
        echo $this->db->affected_rows() > 0 ? '1' : '0';
    }

    function rename_category()
    {
        $id   = (int)$this->input->post('id');
        $name = trim($this->input->post('name'));
        if (!$id || empty($name)) { echo json_encode(array('error' => 'Invalid data')); return; }
        $this->db->where('cat_id', $id)->update('categories', array('name' => $name));
        echo $this->db->affected_rows() >= 0 ? '1' : '0';
    }

    private function make_category_slug($name)
    {
        $slug = strtolower(trim($name));
        $slug = preg_replace('/\s+tours?\s*$/i', '', $slug);
        $slug = preg_replace('/[^a-z0-9]+/', '-', $slug);
        $slug = trim($slug, '-') ?: 'category';
        if (substr($slug, -5) !== '-tour') { $slug .= '-tour'; }
        return $slug;
    }

    function index()
    {
        $this->load->view('form');
    }

    function details()
    {
        $this->load->view('details');
    }

    private function ensure_table()
    {
        if (! $this->db->table_exists('packages')) {
            $this->load->dbforge();
            $this->dbforge->add_field(array(
                'p_id' => array('type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE),
                'category' => array('type' => 'VARCHAR', 'constraint' => 50, 'default' => 'group'),
                'category_slug' => array('type' => 'VARCHAR', 'constraint' => 100, 'default' => 'group-tour'),
                'title' => array('type' => 'VARCHAR', 'constraint' => 255),
                'slug' => array('type' => 'VARCHAR', 'constraint' => 255),
                'days' => array('type' => 'VARCHAR', 'constraint' => 100),
                'amenities' => array('type' => 'TEXT', 'null' => TRUE),
                'amenity_icons' => array('type' => 'TEXT', 'null' => TRUE),
                'highlights' => array('type' => 'TEXT', 'null' => TRUE),
                'details' => array('type' => 'TEXT', 'null' => TRUE),
                'details_image' => array('type' => 'VARCHAR', 'constraint' => 255, 'null' => TRUE),
                'price' => array('type' => 'VARCHAR', 'constraint' => 50),
                'image' => array('type' => 'VARCHAR', 'constraint' => 255, 'null' => TRUE),
                'default_image' => array('type' => 'VARCHAR', 'constraint' => 255, 'null' => TRUE),
                'best_selling' => array('type' => 'TINYINT', 'constraint' => 1, 'default' => 0),
                'status' => array('type' => 'TINYINT', 'constraint' => 1, 'default' => 1),
                'sort_order' => array('type' => 'INT', 'constraint' => 11, 'default' => 0),
            ));
            $this->dbforge->add_key('p_id', TRUE);
            $this->dbforge->create_table('packages', TRUE);
        }
        if ($this->db->table_exists('packages') && ! $this->db->field_exists('slug', 'packages')) {
            $this->load->dbforge();
            $this->dbforge->add_column('packages', array(
                'slug' => array('type' => 'VARCHAR', 'constraint' => 255, 'null' => TRUE, 'after' => 'title'),
            ));
        }
        if ($this->db->table_exists('packages') && ! $this->db->field_exists('category_slug', 'packages')) {
            $this->load->dbforge();
            $this->dbforge->add_column('packages', array(
                'category_slug' => array('type' => 'VARCHAR', 'constraint' => 100, 'null' => TRUE, 'after' => 'category'),
            ));
        }
        if ($this->db->table_exists('packages') && ! $this->db->field_exists('default_image', 'packages')) {
            $this->load->dbforge();
            $this->dbforge->add_column('packages', array(
                'default_image' => array('type' => 'VARCHAR', 'constraint' => 255, 'null' => TRUE, 'after' => 'image'),
            ));
        }
        if ($this->db->table_exists('packages') && ! $this->db->field_exists('amenity_icons', 'packages')) {
            $this->load->dbforge();
            $this->dbforge->add_column('packages', array(
                'amenity_icons' => array('type' => 'TEXT', 'null' => TRUE, 'after' => 'amenities'),
            ));
        }
        if ($this->db->table_exists('packages') && ! $this->db->field_exists('details', 'packages')) {
            $this->load->dbforge();
            $this->dbforge->add_column('packages', array(
                'details' => array('type' => 'TEXT', 'null' => TRUE, 'after' => 'highlights'),
            ));
        }
        if ($this->db->table_exists('packages') && ! $this->db->field_exists('details_image', 'packages')) {
            $this->load->dbforge();
            $this->dbforge->add_column('packages', array(
                'details_image' => array('type' => 'VARCHAR', 'constraint' => 255, 'null' => TRUE, 'after' => 'details'),
            ));
        }
        if ($this->db->table_exists('packages') && ! $this->db->field_exists('price_on_request', 'packages')) {
            $this->load->dbforge();
            $this->dbforge->add_column('packages', array(
                'price_on_request' => array('type' => 'TINYINT', 'constraint' => 1, 'default' => 0, 'after' => 'price'),
            ));
        }
        if ($this->db->table_exists('packages') && ! $this->db->field_exists('description', 'packages')) {
            $this->load->dbforge();
            $this->dbforge->add_column('packages', array(
                'description' => array('type' => 'TEXT', 'null' => TRUE, 'after' => 'title'),
            ));
        }
        if ($this->db->table_exists('packages') && ! $this->db->field_exists('meta_description', 'packages')) {
            $this->load->dbforge();
            $this->dbforge->add_column('packages', array(
                'meta_description' => array('type' => 'VARCHAR', 'constraint' => 320, 'null' => TRUE, 'after' => 'description'),
            ));
        }
        if ($this->db->table_exists('packages') && ! $this->db->field_exists('itinerary_json', 'packages')) {
            $this->load->dbforge();
            $this->dbforge->add_column('packages', array(
                'itinerary_json' => array('type' => 'TEXT', 'null' => TRUE),
            ));
        }
        if ($this->db->table_exists('packages') && ! $this->db->field_exists('inclusions_json', 'packages')) {
            $this->load->dbforge();
            $this->dbforge->add_column('packages', array(
                'inclusions_json' => array('type' => 'TEXT', 'null' => TRUE),
            ));
        }
        if ($this->db->table_exists('packages') && ! $this->db->field_exists('exclusions_json', 'packages')) {
            $this->load->dbforge();
            $this->dbforge->add_column('packages', array(
                'exclusions_json' => array('type' => 'TEXT', 'null' => TRUE),
            ));
        }
        if ($this->db->table_exists('packages') && ! $this->db->field_exists('faqs_json', 'packages')) {
            $this->load->dbforge();
            $this->dbforge->add_column('packages', array(
                'faqs_json' => array('type' => 'TEXT', 'null' => TRUE),
            ));
        }
        $this->sync_slugs();
    }

    private function ensure_large_text_columns()
    {
        if (! $this->db->table_exists('packages')) {
            return;
        }

        $fields = array(
            'description',
            'amenities',
            'amenity_icons',
            'highlights',
            'details',
            'itinerary_json',
            'inclusions_json',
            'exclusions_json',
            'faqs_json',
        );

        foreach ($fields as $field) {
            if (! $this->db->field_exists($field, 'packages')) {
                continue;
            }

            $column = $this->db->query("SHOW COLUMNS FROM `packages` LIKE " . $this->db->escape($field))->row_array();
            if (! $column) {
                continue;
            }

            $type = strtolower((string) $column['Type']);
            if (strpos($type, 'mediumtext') === false) {
                $this->db->query("ALTER TABLE `packages` MODIFY `{$field}` MEDIUMTEXT NULL");
            }
        }

        $this->db->query("ALTER TABLE `packages` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    }

    private function seed_default_cards()
    {
        if ($this->db->count_all('packages') > 0) {
            return;
        }

        foreach ($this->default_cards() as $category => $cards) {
            $sort_order = 1;
            foreach ($cards as $card) {
                $data = array(
                    'category' => $category,
                    'category_slug' => $this->category_slug($category),
                    'title' => $card['title'],
                    'slug' => $this->unique_slug($card['title']),
                    'days' => $card['days'],
                    'amenities' => implode(', ', $card['amenities']),
                    'amenity_icons' => '',
                    'highlights' => implode(', ', $card['highlights']),
                    'details' => $this->default_details_text($card),
                    'details_image' => '',
                    'price' => $card['price'],
                    'image' => '',
                    'default_image' => $card['image'],
                    'best_selling' => !empty($card['best_selling']) ? 1 : 0,
                    'status' => 1,
                    'sort_order' => $sort_order,
                );
                $this->db->insert('packages', $data);
                $sort_order++;
            }
        }
    }

    private function default_cards()
    {
        $file = FCPATH . 'application/modules/home/views/home.php';
        if (! file_exists($file)) {
            return array();
        }

        $source = file_get_contents($file);
        $end = strpos($source, '$promotions = array(');
        if ($end === false) {
            return array();
        }

        $source = substr($source, 0, $end);
        $source = preg_replace('/^\s*<\?php/', '', $source);
        $tours_group = $tours_family = $tours_honeymoon = $tours_luxury = array();
        eval($source);

        return array(
            'group' => $tours_group,
            'family' => $tours_family,
            'honeymoon' => $tours_honeymoon,
            'luxury' => $tours_luxury,
        );
    }

    function save_data()
    {
        try {
            $package_id = !empty($_POST['p_id']) ? (int) $_POST['p_id'] : 0;
            $existing_package = $package_id > 0 ? $this->get_existing_package($package_id) : array();

            $this->load->library('form_validation');
            $this->form_validation->set_rules("category", "Category", "required|trim");
            $this->form_validation->set_rules("title", "Title", "required|trim");
            $this->form_validation->set_rules("days", "Days", "required|trim");
            $this->form_validation->set_rules("price", "Price", "trim");

            if ($this->form_validation->run() == TRUE) {
                $data['category'] = $_POST['category'];
                $data['category_slug'] = $this->category_slug($_POST['category']);
                $data['title'] = $_POST['title'];
                $data['slug'] = $this->unique_slug($_POST['title'], @$_POST['p_id']);
                $data['days'] = $_POST['days'];
                $data['description'] = @$_POST['description'];
                $data['meta_description'] = @$_POST['meta_description'];
                $data['amenities'] = @$_POST['amenities'];
                $data['highlights'] = $_POST['highlights'];
                $data['price_on_request'] = !empty($_POST['price_on_request']) ? 1 : 0;
                $data['price'] = $this->resolve_package_price(isset($_POST['price']) ? $_POST['price'] : null, $existing_package);
                $data['best_selling'] = @$_POST['best_selling'] ? 1 : 0;
                $data['status'] = @$_POST['status'] ? 1 : 0;
                $data['sort_order'] = @$_POST['sort_order'] ? $_POST['sort_order'] : 0;

                if (! empty($_FILES['image']['name'])) {
                    $data['image'] = $this->image_upload();
                    if (@$_POST['old_image']) {
                        $this->remove_image($_POST['old_image']);
                    }
                }

                $old_icons = array_filter(array_map('trim', explode(',', @$_POST['old_amenity_icons'])));
                $keep_icons = array_filter(array_map('trim', explode(',', @$_POST['keep_amenity_icons'])));
                $removed_icons = array_diff($old_icons, $keep_icons);
                if ($removed_icons) {
                    $this->remove_amenity_icons(implode(',', $removed_icons));
                }

                if (! empty($_FILES['amenity_icons']['name'][0])) {
                    $new_icons = $this->amenity_icons_upload();
                    $data['amenity_icons'] = implode(',', array_merge($keep_icons, $new_icons));
                } else if (isset($_POST['keep_amenity_icons'])) {
                    $data['amenity_icons'] = $_POST['keep_amenity_icons'];
                }

                if (isset($_POST['p_id']) && $_POST['p_id']) {
                    $where['p_id'] = $_POST['p_id'];
                    $affected = $this->mdl_packages->update_data($where, $data);
                    return $this->json_response(array(
                        'status' => $affected > 0 ? 'success' : 'noop',
                        'message' => $affected > 0 ? 'Card saved successfully.' : 'No changes were detected.',
                        'package_id' => (int) $where['p_id'],
                    ));
                } else {
                    $created = $this->mdl_packages->add_data($data);
                    return $this->json_response(array(
                        'status' => $created ? 'success' : 'error',
                        'message' => $created ? 'Card created successfully.' : 'Could not create the card.',
                        'package_id' => $created ? (int) $this->db->insert_id() : 0,
                    ), $created ? 200 : 500);
                }
            }
            return $this->json_response(array(
                'status' => 'validation',
                'message' => trim(strip_tags(validation_errors(' ', ' '))) ?: 'Please check the required fields and try again.',
                'html' => validation_errors(),
            ), 422);
        } catch (Throwable $e) {
            return $this->handle_save_exception('save_data', $e);
        }
    }

    function save_details()
    {
        try {
            $is_new = empty($_POST['p_id']);
            $package_id = !empty($_POST['p_id']) ? (int) $_POST['p_id'] : 0;
            $existing_package = $package_id > 0 ? $this->get_existing_package($package_id) : array();

            $this->load->library('form_validation');
            if (!$is_new) {
                $this->form_validation->set_rules("p_id", "Package", "required|trim");
            } else {
                $this->form_validation->set_rules("title", "Title", "required|trim");
                // category is optional — no category = uncategorized, shows in All tab only
            }
            $this->form_validation->set_rules("details", "Details", "trim");
            $this->form_validation->set_rules("price", "Price", "trim");

            if ($this->form_validation->run() == TRUE) {
                $data['description']     = @$_POST['description'];
                $data['meta_description']= @$_POST['meta_description'];
                $data['details']         = @$_POST['details'];
                $data['price_on_request']= !empty($_POST['price_on_request']) ? 1 : 0;
                $data['price']           = $this->resolve_package_price(isset($_POST['price']) ? $_POST['price'] : null, $existing_package);
                $data['days']            = @$_POST['days'];
                $data['highlights']      = @$_POST['highlights'];
                $data['amenities']       = @$_POST['amenities'];
                $data['itinerary_json']  = @$_POST['itinerary_json'];
                $data['inclusions_json'] = @$_POST['inclusions_json'];
                $data['exclusions_json'] = @$_POST['exclusions_json'];
                $data['faqs_json']       = @$_POST['faqs_json'];

                if (!empty($_POST['category'])) {
                    $data['category']      = $this->category_slug($_POST['category']);
                    $data['category_slug'] = $this->category_slug($_POST['category']);
                } else if ($is_new) {
                    $data['category']      = '';
                    $data['category_slug'] = '';
                }

                if (!empty($_FILES['image']['name'])) {
                    $data['image'] = $this->image_upload();
                    if (@$_POST['old_image']) {
                        $this->remove_image($_POST['old_image']);
                    }
                }

                if (!empty($_FILES['details_image']['name'])) {
                    $data['details_image'] = $this->details_image_upload();
                    if (@$_POST['old_details_image']) {
                        $this->remove_details_image($_POST['old_details_image']);
                    }
                } else if (@$_POST['remove_details_image']) {
                    $data['details_image'] = '';
                    if (@$_POST['old_details_image']) {
                        $this->remove_details_image($_POST['old_details_image']);
                    }
                }

                if ($is_new) {
                    $data['title']      = trim($_POST['title']);
                    $data['slug']       = $this->unique_slug($_POST['title']);
                    $data['status']     = 1;
                    $data['sort_order'] = 0;
                    $data['best_selling'] = 0;
                    $created = $this->mdl_packages->add_data($data);
                    return $this->json_response(array(
                        'status' => $created ? 'success' : 'error',
                        'message' => $created ? 'Package created successfully.' : 'Could not create the package.',
                        'package_id' => $created ? (int) $this->db->insert_id() : 0,
                    ), $created ? 200 : 500);
                } else {
                    $where['p_id'] = $_POST['p_id'];
                    $affected = $this->mdl_packages->update_data($where, $data);
                    return $this->json_response(array(
                        'status' => $affected > 0 ? 'success' : 'noop',
                        'message' => $affected > 0 ? 'Package details saved successfully.' : 'No changes were detected.',
                        'package_id' => (int) $where['p_id'],
                    ));
                }
            }
            return $this->json_response(array(
                'status' => 'validation',
                'message' => trim(strip_tags(validation_errors(' ', ' '))) ?: 'Please review the form fields and try again.',
                'html' => validation_errors(),
            ), 422);
        } catch (Throwable $e) {
            return $this->handle_save_exception('save_details', $e);
        }
    }

    function view_data()
    {
        $where = null;
        if (isset($_GET['p_id'])) {
            $where['p_id'] = $_GET['p_id'];
        }

        if (isset($_GET['data'])) {
            $select = $_GET['data'];
        } else {
            $select = "*";
        }

        $return = $this->mdl_packages->view_data($where, $select);
        $this->output->set_content_type('application/json')->set_output(json_encode($return->result_array()));
    }

    function delete_data()
    {
        if (isset($_GET['id']) && $_GET['id']) {
            $this->db->where('p_id', $_GET['id']);
            foreach ($this->db->get("packages")->result() as $row) {
                if ($row->image) {
                    $this->remove_image($row->image);
                }
                if ($row->amenity_icons) {
                    $this->remove_amenity_icons($row->amenity_icons);
                }
            }

            $where['p_id'] = $_GET['id'];
            echo $this->mdl_packages->delete_data($where);
        } else {
            echo "Not Deleted";
        }
    }

    function image_upload()
    {
        $folder = "packages";
        $config['upload_path'] = './assets/temp';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|webp|jfif|WEBP|JFIF';
        $config['new_image'] = "./assets/uploads/$folder/";
        $config['min_width'] = 100;

        $rand_number = mt_rand(0, 85);
        $timestamp = time();
        $config['file_name'] = $rand_number . $timestamp;
        $config['overwrite'] = false;
        $config['remove_spaces'] = true;

        $this->load->library('upload');
        $this->upload->initialize($config);
        if (! $this->upload->do_upload('image')) {
            echo $this->upload->display_errors();
            die();
        } else {
            $image = $this->upload->data();
            if ($image['image_width'] > 900) {
                $config['width'] = 900;
            }
            $config['source_image'] = './assets/temp/' . $image['file_name'];
            $config['maintain_ratio'] = TRUE;

            $this->load->library('image_lib', $config);
            $this->image_lib->initialize($config);
            if (! $this->image_lib->resize()) {
                echo $this->image_lib->display_errors();
                die();
            }

            $this->image_lib->clear();
            $config['source_image'] = './assets/temp/' . $image['file_name'];
            $config['new_image'] = "./assets/uploads/$folder/thumb/";
            $config['file_name'] = $rand_number . $timestamp;
            $config['maintain_ratio'] = TRUE;
            if ($image['image_width'] > 250) {
                $config['width'] = 250;
            }
            $config['overwrite'] = FALSE;
            $this->load->library('image_lib', $config);
            $this->image_lib->initialize($config);
            if (! $this->image_lib->resize()) {
                echo $this->image_lib->display_errors();
                die();
            } else {
                unlink($config['source_image']);
                return $image['file_name'];
            }
        }
    }

    function amenity_icons_upload()
    {
        $uploaded = array();
        $files = $_FILES['amenity_icons'];
        $count = count($files['name']);

        for ($i = 0; $i < $count; $i++) {
            if (empty($files['name'][$i])) {
                continue;
            }

            $_FILES['amenity_icon']['name'] = $files['name'][$i];
            $_FILES['amenity_icon']['type'] = $files['type'][$i];
            $_FILES['amenity_icon']['tmp_name'] = $files['tmp_name'][$i];
            $_FILES['amenity_icon']['error'] = $files['error'][$i];
            $_FILES['amenity_icon']['size'] = $files['size'][$i];

            $config['upload_path'] = './assets/uploads/packages/icons/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|webp|svg|jfif|WEBP|JFIF|SVG';
            $config['file_name'] = mt_rand(0, 85) . time() . '_' . $i;
            $config['overwrite'] = false;
            $config['remove_spaces'] = true;

            $this->load->library('upload');
            $this->upload->initialize($config);
            if (! $this->upload->do_upload('amenity_icon')) {
                echo $this->upload->display_errors();
                die();
            }

            $image = $this->upload->data();
            $uploaded[] = $image['file_name'];
        }

        return $uploaded;
    }

    function remove_image($title)
    {
        if (substr($title, 0, 4) != "http") {
            $path1 = "./assets/uploads/packages/" . $title;
            $path2 = "./assets/uploads/packages/thumb/" . $title;
            if (file_exists($path1)) {
                unlink($path1);
            }
            if (file_exists($path2)) {
                unlink($path2);
            }
        }
    }

    function remove_amenity_icons($icons)
    {
        foreach (array_filter(array_map('trim', explode(',', $icons))) as $icon) {
            if (substr($icon, 0, 4) == "http") {
                continue;
            }
            $path = "./assets/uploads/packages/icons/" . $icon;
            if (file_exists($path)) {
                unlink($path);
            }
        }
    }

    function details_image_upload()
    {
        $folder = "packages/details";
        $upload_path = "./assets/uploads/$folder/";
        if (! is_dir($upload_path)) {
            mkdir($upload_path, 0777, TRUE);
        }

        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = 'gif|jpg|jpeg|png|webp|jfif|bmp|svg|avif|heic|heif|tif|tiff|ico|WEBP|JFIF|SVG';
        $config['file_name'] = mt_rand(0, 85) . time();
        $config['overwrite'] = false;
        $config['remove_spaces'] = true;
        $config['detect_mime'] = TRUE;

        $this->load->library('upload');
        $this->upload->initialize($config);
        if (! $this->upload->do_upload('details_image')) {
            echo $this->upload->display_errors();
            die();
        }

        $image = $this->upload->data();
        return $image['file_name'];
    }

    function remove_details_image($title)
    {
        if (substr($title, 0, 4) != "http") {
            $path = "./assets/uploads/packages/details/" . $title;
            if (file_exists($path)) {
                unlink($path);
            }
        }
    }

    private function create_slug($title)
    {
        $slug = strtolower(trim($title));
        $slug = preg_replace('/[^a-z0-9]+/i', '-', $slug);
        $slug = trim($slug, '-');
        return $slug ? $slug : 'package';
    }

    private function unique_slug($title, $current_id = null)
    {
        $base = $this->create_slug($title);
        $slug = $base;
        $count = 1;

        while ($this->slug_exists($slug, $current_id)) {
            $count++;
            $slug = $base . '-' . $count;
        }

        return $slug;
    }

    private function slug_exists($slug, $current_id = null)
    {
        $this->db->where('slug', $slug);
        if ($current_id) {
            $this->db->where('p_id !=', $current_id);
        }
        return $this->db->count_all_results('packages') > 0;
    }

    private function sync_slugs()
    {
        if (! $this->db->table_exists('packages') || ! $this->db->field_exists('slug', 'packages')) {
            return;
        }

        $used = array();
        $this->db->order_by('p_id', 'asc');
        $rows = $this->db->get('packages')->result_array();

        foreach ($rows as $row) {
            $base = $this->create_slug($row['title']);
            $slug = $base;
            $count = 1;

            while (isset($used[$slug])) {
                $count++;
                $slug = $base . '-' . $count;
            }

            $used[$slug] = true;
            $category_slug = $this->category_slug(!empty($row['category']) ? $row['category'] : $row['category_slug']);
            if ($row['slug'] !== $slug || @$row['category'] !== $category_slug || @$row['category_slug'] !== $category_slug) {
                $this->db->where('p_id', $row['p_id']);
                $this->db->update('packages', array(
                    'category' => $category_slug,
                    'slug' => $slug,
                    'category_slug' => $category_slug,
                ));
            }
        }
    }

    private function category_slug($category)
    {
        $category = strtolower(trim((string) $category));
        if ($category === '') {
            return '';
        }

        $legacy = array('group'=>'group-tour','family'=>'family-tour','honeymoon'=>'honeymoon-tour','luxury'=>'luxury-tour');
        if (isset($legacy[$category])) return $legacy[$category];

        $slug = $this->create_slug($category);
        $slug = preg_replace('/(?:-tour)+$/', '-tour', $slug);

        if (substr($slug, -5) !== '-tour') {
            $slug .= '-tour';
        }

        return $slug;
    }

    private function default_details_text($card)
    {
        $highlights = !empty($card['highlights']) ? implode(', ', $card['highlights']) : 'popular attractions';
        return $card['title'] . ' includes ' . $card['days'] . ' with key highlights such as ' . $highlights . '. Add full package itinerary, inclusions, exclusions, and travel notes from the admin panel.';
    }

    private function json_response(array $payload, $status_code = 200)
    {
        return $this->output
            ->set_status_header($status_code)
            ->set_content_type('application/json')
            ->set_output(json_encode($payload));
    }

    private function get_existing_package($package_id)
    {
        if ($package_id <= 0 || ! $this->db->table_exists('packages')) {
            return array();
        }

        return (array) $this->db->where('p_id', $package_id)->get('packages')->row_array();
    }

    private function resolve_package_price($posted_price, array $existing_package = array())
    {
        if ($posted_price !== null) {
            return trim((string) $posted_price);
        }

        if (!empty($existing_package) && array_key_exists('price', $existing_package)) {
            return (string) $existing_package['price'];
        }

        return '';
    }

    private function handle_save_exception($action, Throwable $e)
    {
        error_log('[admin/packages/' . $action . '] ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine());

        $message = 'A server error occurred while saving the package.';
        if (ENVIRONMENT !== 'production' || in_array($this->input->ip_address(), array('127.0.0.1', '::1'))) {
            $message = $e->getMessage() . ' in ' . basename($e->getFile()) . ':' . $e->getLine();
        }

        return $this->json_response(array(
            'status' => 'error',
            'message' => $message,
        ), 500);
    }
}
?>
