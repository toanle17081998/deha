(function ($) {
    function confirmDelete(){
        return new Promise((resolve, reject)=>{
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    resolve(true)
                }else{
                    reject(false)
                }
            });
        })
    }

    $('.delete-button').click(function (e) {
        e.preventDefault()
        var id = $(this).data('id');
        confirmDelete()
            .then(function(){
                console.log(id)
                $(`#form-delete${id}`).submit();
            }).catch()
    });
})(jQuery);