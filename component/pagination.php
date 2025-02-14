<?php if ($total_rows > $limit): ?>
  <div class="mt-6 flex justify-center">
    <div class="join ">
      <!-- Tombol Home -->
      <a href="?page=1" class="btn btn-outline mx-2 <?= $page == 1 ? 'btn-disabled' : '' ?>">
        Home
      </a>

      <!-- Tombol Previous -->
      <a href="?page=<?= max(1, $page - 1) ?>" class="btn btn-outline mx-2 <?= $page == 1 ? 'btn-disabled' : '' ?>">
        «
      </a>

      <?php
      // Menentukan batas halaman yang ditampilkan
      $start = max(1, $page - 2);
      $end = min($total_pages, $page + 2);

      // Tampilkan halaman pertama jika tidak dalam jangkauan tampilan
      if ($start > 1) {
          echo '<a href="?page=1" class="btn btn-outline">1</a>';
          if ($start > 2) echo '<span class="btn btn-disabled">...</span>';
      }

      // Tampilkan halaman di sekitar halaman aktif
      for ($i = $start; $i <= $end; $i++): ?>
        <a href="?page=<?= $i ?>" class="btn mx-2 <?= $i == $page ? 'btn-primary' : 'btn-outline' ?>">
          <?= $i ?>
        </a>
      <?php endfor;

      // Tampilkan halaman terakhir jika tidak dalam jangkauan tampilan
      if ($end < $total_pages) {
          if ($end < $total_pages - 1) echo '<span class="btn btn-disabled">...</span>';
          echo '<a href="?page=' . $total_pages . '" class="btn btn-outline mx-2">' . $total_pages . '</a>';
      }
      ?>

      <!-- Tombol Next -->
      <a href="?page=<?= min($total_pages, $page + 1) ?>" class="btn btn-outline mx-2 <?= $page == $total_pages ? 'btn-disabled' : '' ?>">
        »
      </a>

      <!-- Tombol Last -->
      <a href="?page=<?= $total_pages ?>" class="btn btn-outline  <?= $page == $total_pages ? 'btn-disabled' : '' ?>">
        Last
      </a>
    </div>
  </div>
<?php endif; ?>