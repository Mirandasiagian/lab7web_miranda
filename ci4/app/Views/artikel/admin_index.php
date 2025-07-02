<?= $this->include('template/admin_header'); ?>

<h2><?= $title; ?></h2>

<!-- Search dan Filter Form -->
<div class="row mb-3">
    <div class="col-md-8">
        <form id="search-form" class="form-inline">
            <input type="text" name="q" id="search-box" value="<?= $q; ?>" 
                   placeholder="Cari judul artikel" class="form-control mr-2" style="width: 250px;">
            <select name="kategori_id" id="category-filter" class="form-control mr-2" style="width: 200px;">
                <option value="">Semua Kategori</option>
                <?php foreach ($kategori as $k): ?>
                    <option value="<?= $k['id_kategori']; ?>" <?= ($kategori_id == $k['id_kategori']) ? 'selected' : ''; ?>>
                        <?= $k['nama_kategori']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <input type="submit" value="Cari" class="btn btn-primary">
            <button type="button" id="reset-btn" class="btn btn-secondary ml-2">Reset</button>
        </form>
    </div>
    <div class="col-md-4 text-right">
        <a href="<?= base_url('/admin/artikel/add'); ?>" class="btn btn-success">Tambah Artikel</a>
    </div>
</div>

<!-- Loading Indicator -->
<div id="loading-indicator" style="display: none; text-align: center; padding: 20px;">
    <div class="spinner-border text-primary" role="status">
        <span class="sr-only">Loading...</span>
    </div>
    <p>Memuat data...</p>
</div>

<!-- Container untuk Artikel -->
<div id="article-container">
    <!-- Data artikel akan dimuat di sini via AJAX -->
</div>

<!-- Container untuk Pagination -->
<div id="pagination-container">
    <!-- Pagination akan dimuat di sini via AJAX -->
</div>

<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Element selectors
    const articleContainer = $('#article-container');
    const paginationContainer = $('#pagination-container');
    const loadingIndicator = $('#loading-indicator');
    const searchForm = $('#search-form');
    const searchBox = $('#search-box');
    const categoryFilter = $('#category-filter');
    const resetBtn = $('#reset-btn');

    // Current state
    let currentSort = 'id';
    let currentOrder = 'DESC';

    // Function untuk fetch data via AJAX
    const fetchData = (url) => {
        // Show loading indicator
        loadingIndicator.show();
        articleContainer.hide();
        paginationContainer.hide();

        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            success: function(data) {
                renderArticles(data.artikel);
                renderPagination(data.pager, data.q, data.kategori_id);
                currentSort = data.sort;
                currentOrder = data.order;
                
                // Hide loading indicator
                loadingIndicator.hide();
                articleContainer.show();
                paginationContainer.show();
            },
            error: function(xhr, status, error) {
                loadingIndicator.hide();
                articleContainer.html('<div class="alert alert-danger">Error loading data: ' + error + '</div>').show();
            }
        });
    };

    // Function untuk render artikel
    const renderArticles = (articles) => {
        let html = '<table class="table table-striped">';
        html += '<thead class="thead-dark">';
        html += '<tr>';
        html += '<th><a href="#" class="sort-link text-white" data-sort="id">ID ' + getSortIcon('id') + '</a></th>';
        html += '<th><a href="#" class="sort-link text-white" data-sort="judul">Judul ' + getSortIcon('judul') + '</a></th>';
        html += '<th>Kategori</th>';
        html += '<th><a href="#" class="sort-link text-white" data-sort="status">Status ' + getSortIcon('status') + '</a></th>';
        html += '<th>Aksi</th>';
        html += '</tr>';
        html += '</thead>';
        html += '<tbody>';

        if (articles.length > 0) {
            articles.forEach(article => {
                html += `
                    <tr>
                        <td>${article.id}</td>
                        <td>
                            <b>${article.judul}</b>
                            <p><small class="text-muted">${article.isi.substring(0, 50)}...</small></p>
                        </td>
                        <td><span class="badge badge-info">${article.nama_kategori || 'Tidak ada kategori'}</span></td>
                        <td><span class="badge badge-success">${article.status}</span></td>
                        <td>
                            <a class="btn btn-sm btn-info" href="<?= base_url('/admin/artikel/edit/') ?>${article.id}">Ubah</a>
                            <a class="btn btn-sm btn-danger" onclick="return confirm('Yakin menghapus data?');" 
                               href="<?= base_url('/admin/artikel/delete/') ?>${article.id}">Hapus</a>
                        </td>
                    </tr>
                `;
            });
        } else {
            html += '<tr><td colspan="5" class="text-center">Tidak ada data ditemukan.</td></tr>';
        }
        
        html += '</tbody></table>';
        articleContainer.html(html);
    };

    // Function untuk render pagination
    const renderPagination = (pager, q, kategori_id) => {
        if (!pager.links || pager.links.length === 0) {
            paginationContainer.html('');
            return;
        }

        let html = '<nav aria-label="Page navigation">';
        html += '<ul class="pagination justify-content-center">';
        
        pager.links.forEach(link => {
            let url = link.url ? `${link.url}&q=${encodeURIComponent(q)}&kategori_id=${kategori_id}&sort=${currentSort}&order=${currentOrder}` : '#';
            let activeClass = link.active ? 'active' : '';
            let disabledClass = !link.url ? 'disabled' : '';
            
            html += `<li class="page-item ${activeClass} ${disabledClass}">`;
            if (link.url) {
                html += `<a class="page-link pagination-link" href="${url}">${link.title}</a>`;
            } else {
                html += `<span class="page-link">${link.title}</span>`;
            }
            html += '</li>';
        });
        
        html += '</ul></nav>';
        paginationContainer.html(html);
    };

    // Function untuk mendapatkan icon sorting
    const getSortIcon = (field) => {
        if (currentSort === field) {
            return currentOrder === 'ASC' ? '↑' : '↓';
        }
        return '↕';
    };

    // Event handler untuk form search
    searchForm.on('submit', function(e) {
        e.preventDefault();
        const q = searchBox.val();
        const kategori_id = categoryFilter.val();
        fetchData(`<?= base_url('/admin/artikel') ?>?q=${encodeURIComponent(q)}&kategori_id=${kategori_id}&sort=${currentSort}&order=${currentOrder}`);
    });

    // Event handler untuk category filter change
    categoryFilter.on('change', function() {
        searchForm.trigger('submit');
    });

    // Event handler untuk reset button
    resetBtn.on('click', function() {
        searchBox.val('');
        categoryFilter.val('');
        currentSort = 'id';
        currentOrder = 'DESC';
        fetchData('<?= base_url('/admin/artikel') ?>');
    });

    // Event handler untuk pagination links
    $(document).on('click', '.pagination-link', function(e) {
        e.preventDefault();
        const url = $(this).attr('href');
        if (url !== '#') {
            fetchData(url);
        }
    });

    // Event handler untuk sorting
    $(document).on('click', '.sort-link', function(e) {
        e.preventDefault();
        const sortField = $(this).data('sort');
        
        // Toggle order jika field yang sama
        if (currentSort === sortField) {
            currentOrder = currentOrder === 'ASC' ? 'DESC' : 'ASC';
        } else {
            currentSort = sortField;
            currentOrder = 'ASC';
        }
        
        const q = searchBox.val();
        const kategori_id = categoryFilter.val();
        fetchData(`<?= base_url('/admin/artikel') ?>?q=${encodeURIComponent(q)}&kategori_id=${kategori_id}&sort=${currentSort}&order=${currentOrder}`);
    });

    // Initial load
    fetchData('<?= base_url('/admin/artikel') ?>');
});
</script>

<style>
.form-inline {
    display: flex;
    align-items: center;
    gap: 10px;
}

.sort-link {
    text-decoration: none;
    color: inherit;
}

.sort-link:hover {
    text-decoration: none;
    color: #f8f9fa;
}

.spinner-border {
    width: 3rem;
    height: 3rem;
}

.badge {
    font-size: 0.75em;
}

.pagination-link {
    cursor: pointer;
}

.table th {
    border-top: none;
}
</style>

<?= $this->include('template/admin_footer'); ?>