    <!-- Modal add TodoList -->
    <dialog id="modal_tambah_todoList" class="modal">
      <div class=" modal-box bg-glass ">
        <form method="dialog">
          <button class="btn btn-sm btn-circle btn-ghost absolute right-5 top-5 text-2xl top-2">✕</button>

        </form>
        <form class="card-body" method="POST" action="../auth/proses_tambahData.php">
          <div class="form-control mb-2 ">
            <label class="label">
              <span class="text-xl uppercase font-semibold">Todo</span>
            </label>
            <input type="text" placeholder="Masukan Judul" class="input input-bordered bg-glass"
              id="judul_todo" name="judul_todo" required />
          </div>
          <div class="form-control ">
            <label class="label">
              <span class="text-xl uppercase font-semibold">Detail</span>
            </label>
            <textarea placeholder="Masukan Deskirpsi" class="input input-bordered bg-glass  pt-2"
              id="deskripsi_todo" name="deskripsi_todo" required></textarea>
          </div>
          <div class="form-control mt-6">
            <button class="btn btn-primary">Create</button>
          </div>
        </form>
      </div>
      </div>
    </dialog>

    <!-- Modal Delete -->
    <dialog id="modal_delete"
      class="modal modal-bottom sm:modal-middle bg-cyan-600 bg-clip-padding backdrop-filter  backdrop-blur bg-opacity-0 backdrop-saturate-100 backdrop-contrast-75">
      <div class="modal-box">
        <h3 class="text-lg font-bold">Pesan !!</h3>
        <p class="py-4">
          Apakah Anda yakin ingin menghapusnya?
        </p>
        <div class="modal-action">
          <button class="btn btn-sm btn-circle btn-ghost absolute right-5 top-5 text-2xl"
            onclick="modal_delete.close()">✕</button>
          <form id="deleteForm" method="POST" action="../auth/proses_delete.php">
            <input type="hidden" name="id_todo" id="deleteId">
            <button type="submit" class="btn btn-error mr-2">Delete</button>
          </form>
        </div>
      </div>
    </dialog>

    <!-- Modal Update  -->
    <dialog id="moodal_update" class="modal">
      <div class="modal-box bg-glass">
        <form method="dialog">
          <button class="btn btn-sm btn-circle btn-ghost absolute right-5 top-5 text-2xl">✕</button>
        </form>
<form id="updateForm" class="card-body" method="POST" action="../auth/proses_update.php">
          <!-- Input hidden untuk menyimpan ID To-Do -->
          <input type="hidden" id="update_id" name="id_todo">

          <div class="form-control mb-2">
            <label class="label">
              <span class="text-xl uppercase font-semibold">Todo</span>
            </label>
            <input type="text" id="update_judul" name="judul_todo" placeholder="Masukan Judul"
              class="input input-bordered bg-glass" required />
          </div>
          <div class="form-control">
            <label class="label">
              <span class="text-xl uppercase font-semibold">Detail</span>
            </label>
            <input type="text" id="update_deskripsi" name="deskripsi_todo" placeholder="Masukan Deskripsi"
              class="input input-bordered bg-glass" required />
          </div>
          <div class="form-control mt-6">
            <button type="submit" class="btn btn-primary">UPDATE</button>
          </div>
        </form>
      </div>
    </dialog>
