<div class="form-group">
        <div id="addTicket">  
           
           <div class="table-responsive">  
               <table class="table" id="addTicketDynamic">  
                    <thead>
                            <tr>
                              <th scope="col">Název vstupenky</th>
                              <th scope="col">Cena (Kč)</th>
                              <th scope="col"></th>
                            </tr>
                          </thead>
                          <tbody>
                </tbody> 
               </table>
               <button type="button" name="addNextTicket" id="addNextTicket" class="btn btn-success">Přidat další</button>  
           </div>
        </div>  
   </div> 



<script>
        $(document).ready(function(){
            var i = 0;
            
            $('#addNextTicket').click(function(){
                i++;  
                $('#addTicketDynamic').append('<tr id="row'+i+'" class="dynamicallyAdded"><td class="w-75"><input type="text" name="ticket['+i+'][name]" placeholder="Název" class="form-control" required/></td><td><input type="number" name="ticket['+i+'][price]" placeholder="Cena" class="form-control" required min="0" max="99999" step="1" /></td>  <td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
            });
            
            $(document).on('click', '.btn_remove', function(){  
                var button_id = $(this).attr("id");   
                $('#row'+button_id+'').remove();  
             });  
        });
</script>

