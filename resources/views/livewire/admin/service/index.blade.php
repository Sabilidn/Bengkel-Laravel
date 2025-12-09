<x-layouts.app>
    @livewire('admin.service.service-table')
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: "Apakah kamu yakin?",
                text: "Data ini akan dihapus dan tidak bisa dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, hapus!"
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('delete', id); // Kirim ke Livewire
                }
            });
        }
    
        // Menangkap event browser dari Livewire
        window.addEventListener('delete', () => {
            Swal.fire(
                'Terhapus!',
                'Data berhasil dihapus.',
                'success'
            );
        });
    </script>   
</x-layouts.app>
