
<style>
.blog-admin-wrap { padding: 0 6px; }

.blog-search-bar {
    display: flex;
    align-items: center;
    gap: 10px;
    background: #fff;
    border: 1.5px solid #d0d5dd;
    border-radius: 8px;
    padding: 8px 14px;
    margin-bottom: 18px;
    box-shadow: 0 1px 4px rgba(0,0,0,.06);
    transition: border-color .2s;
}
.blog-search-bar:focus-within { border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59,130,246,.12); }
.blog-search-bar i { color: #9ca3af; font-size: 15px; flex-shrink: 0; }
.blog-search-bar input {
    border: none; outline: none; background: transparent;
    width: 100%; font-size: 14px; color: #374151;
}
.blog-search-bar input::placeholder { color: #9ca3af; }

.blog-table { width: 100%; border-collapse: separate; border-spacing: 0; }
.blog-table thead tr { background: #f8fafc; }
.blog-table thead th {
    padding: 11px 14px; font-size: 12px; font-weight: 700;
    color: #6b7280; text-transform: uppercase; letter-spacing: .5px;
    border-bottom: 2px solid #e5e7eb; white-space: nowrap;
}
.blog-table tbody tr {
    transition: background .15s;
}
.blog-table tbody tr:hover { background: #f0f7ff; }
.blog-table tbody td {
    padding: 12px 14px; font-size: 13.5px; color: #374151;
    border-bottom: 1px solid #f3f4f6; vertical-align: middle;
}
.blog-table .blog-thumb {
    width: 72px; height: 52px; object-fit: cover;
    border-radius: 6px; border: 1px solid #e5e7eb;
    display: block;
}
.blog-thumb-placeholder {
    width: 72px; height: 52px; border-radius: 6px;
    background: #f3f4f6; display: flex; align-items: center;
    justify-content: center; color: #d1d5db; font-size: 20px;
}
.blog-table .td-title { max-width: 200px; font-weight: 600; color: #111827; line-height: 1.4; }
.blog-table .td-date, .blog-table .td-time { white-space: nowrap; color: #6b7280; }
.blog-table .td-author { color: #374151; }

.blog-action-btn {
    display: inline-flex; align-items: center; justify-content: center;
    width: 32px; height: 32px; border-radius: 7px; border: none;
    cursor: pointer; transition: background .15s, color .15s; text-decoration: none;
}
.blog-action-btn.edit { background: #eff6ff; color: #3b82f6; }
.blog-action-btn.edit:hover { background: #3b82f6; color: #fff; }
.blog-action-btn.del { background: #fff1f2; color: #ef4444; }
.blog-action-btn.del:hover { background: #ef4444; color: #fff; }
.blog-action-btn i { font-size: 13px; }

.blog-pagination { margin-top: 14px; }
</style>

<div class="blog-admin-wrap">
    <div class="blog-search-bar">
        <i class="fa fa-search"></i>
        <input type="text" ng-model="search_text" placeholder="Search by title, author, date…">
    </div>

    <div class="table-responsive">
        <table class="blog-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Author</th>
                    <th>Image</th>
                    <th style="width:90px; text-align:center;">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr dir-paginate="y in datadb | filter: search_text | itemsPerPage: 8">
                    <td class="td-title">{{y.title}}</td>
                    <td class="td-date">{{y.date}}</td>
                    <td class="td-time">{{y.time || '—'}}</td>
                    <td class="td-author">{{y.author || 'Admin'}}</td>
                    <td>
                        <img ng-if="y.image"
                             ng-src="<?= base_url() ?>assets/uploads/blog/thumb/{{y.image}}"
                             class="blog-thumb" alt="Blog image" loading="lazy">
                        <div ng-if="!y.image" class="blog-thumb-placeholder">
                            <i class="fa fa-image"></i>
                        </div>
                    </td>
                    <td style="text-align:center;">
                        <a href="javascript:void(0)"
                           ng-click="update_call(y)"
                           data-toggle="modal" data-target=".bs-example-modal-sm"
                           class="blog-action-btn edit" title="Edit">
                            <i class="fa fa-pencil"></i>
                        </a>
                        &nbsp;
                        <a href="javascript:void(0)"
                           ng-click="delete_data(y.b_id)"
                           class="blog-action-btn del" title="Delete">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="blog-pagination">
        <dir-pagination-controls boundary-links="true" on-page-change="pageChangeHandler(newPageNumber)" template-url="app/pagination"></dir-pagination-controls>
    </div>
</div>
