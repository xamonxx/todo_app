<?php if (isset($_GET['status'])): ?>
<div class="toast toast-center ">
    <div class="alert <?php echo $_GET['status'] === 'success' ? 'alert-success' : 'alert-error'; ?> shadow-lg">
        <div>
            <span>
                <?php echo htmlspecialchars($_GET['message']); ?>
            </span>
        </div>
    </div>
</div>
<script>
    setTimeout(() => {
        document.querySelector('.toast').remove();
    }, 3000);
</script>
<?php endif; ?>