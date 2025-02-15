  // Fungsi untuk mengubah tema
  function setTheme(theme) {
    document.documentElement.setAttribute('data-theme', theme);
    localStorage.setItem('theme', theme); // Simpan tema yang dipilih
  }

  // Memuat tema yang tersimpan di localStorage saat halaman dimuat
  window.onload = function () {
    const savedTheme = localStorage.getItem('theme') || 'default'; // Tema default jika tidak ada yang disimpan
    setTheme(savedTheme); // Terapkan tema yang tersimpan

    // Set input radio yang dipilih sesuai tema yang tersimpan
    const themeRadio = document.querySelector(`input[value="${savedTheme}"]`);
    if (themeRadio) {
      themeRadio.checked = true;
    }

    // Event listener untuk setiap radio button
    const themeControllers = document.querySelectorAll('.theme-controller');
    themeControllers.forEach((controller) => {
      controller.addEventListener('change', (e) => {
        setTheme(e.target.value);
      });
    });
  };
  // Fungsi untuk menandai tugas sebagai selesai atau belum selesai
function toggleStatus(id, currentStatus) {
    let newStatus = (currentStatus === 'completed') ? 'pending' : 'completed';

    fetch(`../auth/update_status.php?id=${id}&status=${newStatus}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                let title = document.getElementById(`title-${id}`);
                let date = document.getElementById(`task-${id}-date`);
                let description = document.getElementById(`description-${id}`);
                let btn = document.getElementById(`btn-${id}`);

                if (newStatus === 'completed') {
                    title.innerHTML = `<del>${title.textContent}</del>`;
                    date.innerHTML = `<del>${date.textContent}</del>`;
                    description.innerHTML = `<del>${description.textContent}</del>`;
                    btn.innerHTML = '<i class="fas fa-check-circle text-green-500"></i>';
                    btn.setAttribute("onclick", `toggleStatus(${id}, 'completed')`);
                } else {
                    title.innerHTML = title.textContent.replace(/<\/?del>/g, '');
                    date.innerHTML = date.textContent.replace(/<\/?del>/g, '');
                    description.innerHTML = description.textContent.replace(/<\/?del>/g, '');
                    btn.innerHTML = '<i class="far fa-circle"></i>';
                    btn.setAttribute("onclick", `toggleStatus(${id}, 'pending')`);
                }
            }
        })
        .catch(error => console.error('Error:', error));
}
  
document.addEventListener("DOMContentLoaded", function () {
    // Ambil semua tombol edit
    const editButtons = document.querySelectorAll(".edit-btn");

    editButtons.forEach(button => {
        button.addEventListener("click", function () {
            // Ambil data dari tombol
            const id = this.getAttribute("data-id");
            const judul = this.getAttribute("data-judul");
            const deskripsi = this.getAttribute("data-deskripsi");

            // Isi form dengan data dari tombol
            document.getElementById("update_id").value = id;
            document.getElementById("update_judul").value = judul;
            document.getElementById("update_deskripsi").value = deskripsi;
        });
    });

    // AJAX untuk submit form update
    document.getElementById("updateForm").addEventListener("submit", function (e) {
        e.preventDefault(); // Cegah reload halaman

        const formData = new FormData(this);

        fetch("../auth/proses_update.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json()) // Menangani respons sebagai JSON
        .then(result => {
            // Kirim status dan pesan untuk ditampilkan pada toast
            const status = result.status;
            const message = result.message;
            
            // Redirect untuk memicu tampilan notifikasi
            window.location.href = `../app/index.php?status=${status}&message=${encodeURIComponent(message)}`;
        })
        .catch(error => console.error("Error:", error));
    });
});


  function togglePin(id, isPinned) {
    fetch('../auth/proses_pin.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `id_todo=${id}&pinned=${isPinned ? 0 : 1}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const task = document.querySelector(`[data-id='${id}']`);
            task.classList.toggle('pinned-task', !isPinned);

            const pinIcon = task.querySelector('.pin-icon');
            pinIcon.setAttribute('fill', isPinned ? 'gray' : 'yellow');
        } else {
            alert('Gagal memperbarui status pin.');
        }
    })
    .catch(error => console.error('Error:', error));
};


  document.querySelectorAll('.pin-btn').forEach(button => {
    button.addEventListener('click', function() {
        const taskId = this.getAttribute('data-id');
        const isPinned = this.getAttribute('data-pinned') === "1" ? 0 : 1;

        fetch('../auth/proses_pin.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `id_todo=${taskId}&pinned=${isPinned}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.reload(); // Reload untuk melihat perubahan
            } else {
                alert('Gagal memperbarui status pin!');
            }
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
  // Elemen input untuk form tambah
  const judulTodo = document.getElementById("judul_todo");
  const deskripsiTodo = document.getElementById("deskripsi_todo");

  // Elemen input untuk form update
  const updateJudul = document.getElementById("update_judul");
  const updateDeskripsi = document.getElementById("update_deskripsi");

  // Fungsi untuk menampilkan jumlah karakter
  function createCounter(input) {
    const counter = document.createElement("span");
    counter.className = "text-sm text-gray-400 mt-1";
    input.parentNode.appendChild(counter);
    return counter;
  }

  // Tambahkan counter ke setiap input
  const judulCounter = createCounter(judulTodo);
  const deskripsiCounter = createCounter(deskripsiTodo);
  const updateJudulCounter = createCounter(updateJudul);
  const updateDeskripsiCounter = createCounter(updateDeskripsi);

  // Fungsi untuk update panjang karakter
  function updateCounter(input, counter, maxLength) {
    let length = input.value.length;
    if (length > maxLength) {
      input.value = input.value.substring(0, maxLength);
      length = maxLength;
    }
    counter.textContent = `${length}/${maxLength} karakter`;
  }

  // Event listener untuk semua input
  function addInputListener(input, counter, maxLength) {
    if (!input) return; // Pastikan elemen ada sebelum menambahkan event listener
    input.addEventListener("input", function () {
      updateCounter(input, counter, maxLength);
    });
    updateCounter(input, counter, maxLength); // Inisialisasi pertama kali
  }

  // Terapkan ke semua input
  addInputListener(judulTodo, judulCounter, 50);
  addInputListener(deskripsiTodo, deskripsiCounter, 999);
  addInputListener(updateJudul, updateJudulCounter, 50);
  addInputListener(updateDeskripsi, updateDeskripsiCounter, 999);
});

  document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.querySelector("input[type='text'][placeholder='Search']");
    const todoCards = document.querySelectorAll(".todo");

    searchInput.addEventListener("input", function () {
      const searchTerm = searchInput.value.toLowerCase();

      todoCards.forEach(card => {
        const title = card.querySelector(".todo-text").textContent.toLowerCase();
        const description = card.querySelector("p.mb-4").textContent.toLowerCase();

        if (title.includes(searchTerm) || description.includes(searchTerm)) {
          card.style.display = "block";
        } else {
          card.style.display = "none";
        }
      });
    });
  });
  
  function createSnowflake() {
    const snowflake = document.createElement("div");
    snowflake.innerHTML = "❄";
    snowflake.classList.add("snowflake");
    
    // Set posisi random di atas layar
    snowflake.style.left = Math.random() * 100 + "vw";
    snowflake.style.animationDuration = Math.random() * 5 + 5 + "s"; // 2-5 detik
    snowflake.style.fontSize = Math.random() * 5 + 15 + "px"; // 10-20px
    
    document.body.appendChild(snowflake);
    
    // Hapus elemen setelah jatuh ke bawah
    setTimeout(() => {
      snowflake.remove();
    }, 5000);
  };
  // Tambahkan salju setiap 200ms
  setInterval(createSnowflake, 200);
  
  //
document.addEventListener("DOMContentLoaded", function () {
    // Hapus parameter status dan message dari URL setelah 1 detik
    setTimeout(() => {
        window.history.replaceState({}, document.title, window.location.pathname);
    }, 1000);
});

