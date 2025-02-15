
<?php include '../auth/read_data.php'; ?>
<?php include '../auth/fitur_pagination.php'; ?>

<!DOCTYPE html>
<html lang="en" data-theme="black">
<head>
  <meta name="author" content="xamon">
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="theme-color" content="#4c1d95" />
  <!-- tailwindcss & daisyui -->
  <link href="../assets/css/output.css" rel="stylesheet">
  <link href="../assets/css/custom.css" rel="stylesheet">
  <link rel="icon" href="../assets/img/logo.png" type="png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <title>Todo App</title>
</head>
<style type="text/tailwindCss">


  .custom-del {
    text-decoration-color: black !important;
  text-decoration-thickness: 5px !important;
  
 @layer utilities {
  .scrollbar-daisy::-webkit-scrollbar {
    width: 8px;
    height: 8px;
  }

  .scrollbar-daisy::-webkit-scrollbar-thumb {
    background-color: hsl(var(--b3)); /* Mengikuti warna base DaisyUI */
    border-radius: 10px;
  }

  .scrollbar-daisy::-webkit-scrollbar-track {
    background: hsl(var(--b2)); /* Warna track mengikuti theme DaisyUI */
    border-radius: 10px;
  }
  }
  
</style>
<body class="dots-pattern pb-[700px] scroll-smooth">
  <!-- start navbar -->
  <div class="max-w-full h-20 mt-[-80px] shadow-[0px_82px_207px_10px_rgba(165,_39,_255,_0.48)]">
   
  </div>
  <nav class="navbar text-neutral-content px-4">
    <div class="flex-1 justify-between ">
      <div class="dropdown">
        <div tabindex="0" role="button" class="btn m-1 text-primary bg-glass ring-1 ring-primary" id="theme-selector">
          Theme
          <svg width="12px" height="12px" class="inline-block h-2 w-2 fill-current opacity-60"
            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2048 2048">
            <path d="M1799 349l242 241-1017 1017L7 590l242-241 775 775 775-775z"></path>
          </svg>
        </div>
        <?php include '../component/theme.php'; ?>
      </div>
      <a class=" btn btn-ghost normal-case text-xl ">
        <span class="text-primary">TODO App</span> 📝</a>
    </div>
  </nav>
  <!-- end Navbar -->

  <!-- start content -->
  <main class="p-6">
    <div class="flex mx-3  justify-between lg:justify-center items-center lg:gap-6 mb-6">
<form method="GET" action="">
  <div class="mr-2 bg-glass rounded-lg flex items-center gap-2 px-3 py-2">
<input type="text" name="search" value="<?= htmlspecialchars($search) ?>"
  class="w-full text-base outline-none bg-transparent  placeholder:text-primary"
  placeholder="Search"
/>
    <button type="submit">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="h-4 w-4 text-gray-500">
        <path fill-rule="evenodd" d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z" clip-rule="evenodd" />
      </svg>
    </button>
  </div>
</form>
      <button class="btn btn-primary btn-outline font-semibold" onclick="modal_tambah_todoList.showModal()">Add
        Todo
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
          class="animate__delay-2s animate__animated animate__rotateIn size-6 mt-[-4px]">
          <path fill-rule="evenodd"
            d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V9Z"
            clip-rule="evenodd" />
        </svg>
      </button>
    </div>
    <!-- start modal -->
<?php include "../component/modal.php" ?>
    <!-- end modal -->
<?php if (mysqli_num_rows($data_todo) > 0): ?>
  <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 gap-2">
    <?php while ($todo = mysqli_fetch_assoc($data_todo)): ?>
      <!-- Task 1 -->
      <div class="todo card shadow-xl bg-glass hover:ring-1 ring-primary hover:scale-95 scale-90  hover:shadow-[0px_20px_207px_10px_rgba(165,_39,_255,_0.48)] transition-all animate__animated animate__fadeIn animate__delay-1s <?= $todo['status'] === 'completed' ? '' : ''; ?>">
       <div class="flex justify-center">
       <div class="<?= $todo['status'] === 'completed' ? ' text-center font-semibold bg-green-600 w-52 text-white py-2 rounde rounded-bl-lg rounded-br-lg opacity-40' : 'hidden'; ?>" >completed</div></div>
        <div class="card-body">
          <!-- Tambahkan ikon pin jika tugas dipin -->
    <?php if ($todo['pinned']): ?>
        <i class="fa-solid fa-star fa-flip-vertical fa-lg absolute z-20 top-5 left-2 text-primary" ></i>
    <?php endif; ?>

    <p class="text-lg">
          <div class="flex">
            <!-- judul_todo -->
<h2 class="card-title todo-text w-[70%]" id="title-<?= $todo['id_todo']; ?>">
  <?= ($todo['status'] === 'completed') ? '<del class="line-through custom-del ">' . htmlspecialchars($todo['judul_todo']) . '</del>' : htmlspecialchars($todo['judul_todo']); ?>
</h2>
            <!-- tgl todo -->
            <p class="text-center" id="task-<?= $todo['id_todo']; ?>-date">
              <?= ($todo['status'] === 'completed') ? '<del>' . date("d M Y", strtotime($todo['created_at'])) . '</del>' : date("d M Y", strtotime($todo['created_at'])); ?>
            </p>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
              class="size-6 ">
              <path
                d="M12.75 12.75a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM7.5 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM8.25 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM9.75 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM10.5 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM12.75 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM14.25 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM15 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM16.5 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM15 12.75a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM16.5 13.5a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" />
              <path fill-rule="evenodd"
                d="M6.75 2.25A.75.75 0 0 1 7.5 3v1.5h9V3A.75.75 0 0 1 18 3v1.5h.75a3 3 0 0 1 3 3v11.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V7.5a3 3 0 0 1 3-3H6V3a.75.75 0 0 1 .75-.75Zm13.5 9a1.5 1.5 0 0 0-1.5-1.5H5.25a1.5 1.5 0 0 0-1.5 1.5v7.5a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5v-7.5Z"
                clip-rule="evenodd" />
            </svg>
          </div>
          <!-- Deskripsi TODO -->
          <p class="break-words  w-full mb-4 pt-2" id="description-<?= $todo['id_todo']; ?>">
            <?= ($todo['status'] === 'completed') ? '<del>' . htmlspecialchars($todo['deskripsi_todo']) . '</del>' : htmlspecialchars($todo['deskripsi_todo']);?>
          </p>
          <div class="card-actions flex justify-between items-center mt-4">
            <div class="flex justify-between items-center">
              <svg xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20" fill="currentColor" class="size-5">
                <path fill-rule="evenodd"
                  d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm.75-13a.75.75 0 0 0-1.5 0v5c0 .414.336.75.75.75h4a.75.75 0 0 0 0-1.5h-3.25V5Z"
                  clip-rule="evenodd" />
              </svg>
              <p class="text-sm text-gray-500 mx-2">
                <?= ($todo['status'] === 'completed') ? '<del>' . date("H:i:s", strtotime($todo['updated_at'])) . '</del>' : date("H:i:s", strtotime($todo['updated_at'])); ?> WIB
              </p>
            </div>
            <div class="flex justify-between gap-2 items-center">
<input id="btn-<?= $todo['id_todo']; ?>" 
       type="checkbox" 
       class="checkbox checkbox-primary ring-1 ring-primary scale-105" 
       onclick="toggleStatus(<?= $todo['id_todo']; ?>, '<?= $todo['status']; ?>')" 
       <?= ($todo['status'] === 'completed') ? 'checked ring-primary' : ''; ?> />
              <button class="btn btn-sm px-4 btn-outline text-yellow-400 pin-btn"
  data-id="<?= $todo['id_todo']; ?>" 
  data-pinned="<?= $todo['pinned']; ?>">        <i class="fa-solid fa-star fa-flip-vertical fa-lg" style="color: #FFD43B;"></i>
</button>
<!-- Untuk teks agar dicoret saat status completed -->

              <button class="btn btn-sm px-4 btn-outline text-indigo-400 edit-btn"
                data-id="<?= $todo['id_todo']; ?>"
                data-judul="<?= htmlspecialchars($todo['judul_todo']); ?>"
                data-deskripsi="<?= htmlspecialchars($todo['deskripsi_todo']); ?>"
                onclick="moodal_update.showModal()">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                  class="size-6 animate__animated animate__rubberBand   animate__delay-2s">
                  <path
                    d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                  <path
                    d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                </svg>
              </button>
              <button class="btn btn-sm px-4 btn-outline text-error"
                onclick="openModalDelete(<?= $todo['id_todo']; ?>)">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                  class="size-6 animate__animated animate__headShake   animate__delay-3s">
                  <path fill-rule="evenodd"
                    d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z"
                    clip-rule="evenodd" />
                </svg>
              </button>
            </div>
            
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
<?php else: ?>
  <div class="flex justify-center mt-56 lg:mt-20">
    <div role="alert" class="alert lg:w-96 shadow-[0px_20px_207px_10px_rgba(165,_39,_255,_0.48)]">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
        viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
      </svg>
      <span>Tidak ada tugas !</span>
    </div>
  </div>
  <?php endif; ?>
  <?php include '../component/pagination.php'; ?>
  </main>
  <!-- end content -->
  <!-- Notifikasi -->
  <?php include '../component/notif.php'; ?>
</body>
<script>
  const modalDelete = document.getElementById('modal_delete');
  const deleteIdInput = document.getElementById('deleteId');

  function openModalDelete(id) {
    deleteIdInput.value = id;
    modalDelete.showModal();
  }

  function closeModalDelete() {
    modalDelete.close();
  }
  

</script>
<script src="../assets/js/main.js"></script>
</html>