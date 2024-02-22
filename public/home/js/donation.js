
$(document).ready(function() {
    $('#dry').on('submit', function(e) {
        e.preventDefault();
        $('#mainSpinner').removeClass('d-none');
        
        $.ajax({
            url: "{{route('dist.donations.donationType')}}",
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
            },
            success: function(data) {
                if(data == 200){
                    $('#mainSpinner').addClass('d-none');
                    $('#donation2').removeClass('d-none');
                }else{
                    $('#alert').removeClass('d-none');
                    $('#alert').inner('p').text(data);
                }
            }
        })
    });
})