
        {{ csrf_field() }}

     
     <script>
     $(document).ready(function(){
     
      $('#venue_name_livesearch').keyup(function(){ 
             var query = $(this).val();
             if(query != '')
             {
              var _token = $('input[name="_token"]').val();
              $.ajax({
               url:"{{ route('venues.fetch') }}",
               method:"POST",
               data:{query:query, _token:_token},
               success:function(data){
                $('#venuesList').fadeIn();  
                         $('#venuesList').html(data);
               }
              });
             }
         });
     
         $(document).on('click', 'li', function(){  
             $('#venue_name_livesearch').val($(this).text());  
             $('#venuesList').fadeOut();  
         });  
     
     });
     </script>

