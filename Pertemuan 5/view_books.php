<?php include('./header.php') ?>
<script>
// searchBooks() saat halaman dimuat
window.addEventListener('load', function() {
    searchBooks();
});
</script>
<div class="card mt-5">
    <div class="card-header">Books Data</div>
    <div class="card-body">
    <input class="form-control mb-2" type="text" id="searchInput" onkeyup="searchBooks()" placeholder="Cari berdasarkan judul...">
    <div id="searchResults"></div>  
    <div id="bookDetail"></div>  
    </div>
</div>
<?php include('./footer.php') ?>