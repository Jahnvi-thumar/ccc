
    let replyData = [];
    let commentId = 0;
    class changeForm{

        constructor(){
            console.log('constructore...');
            this.init();
        }

        init(){
            console.log('init...');
            this.bindInput();
        }

        bindInput(){
            console.log('bind...');
            $(document).on('click', '.addreplybtn', function() {
                const input = $(`<input 
                    type="text" 
                    name="comment[name]" 
                    class="reply-input"
                    placeholder="Enter value" 
                    style="display:block; margin-top:10px;" 
                />`);
                
                $(this).append(input); 
                commentId = $(this).data('comment-id') || 0;
                console.log('commentId: ', commentId);
            });
            this.insertData();
        }

        insertData(){
            $('#submit-ans').off('click').on('click', function() {
                replyData = []; 
        
                $('.reply-input').each(function() {
                    let val = $(this).val();
                    if (val.trim() !== '') {
                        replyData.push(val);
                    }
                    $(this).remove();
                });

                console.log('Stored Reply Data:', replyData);
                console.log("submit Clicked.....");

                $.ajax({
                    url: 'http://localhost/mvc_copy/ticket/ticket/save/',
                    type: 'POST',
                    data: {
                        ticket_id: 1,
                        parent_id: commentId,
                        name: replyData
                    },
                    success: function(response) {
                        console.log('Raw server response:', response);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error inserting data:', error);
                    }
                });
            });
        }
    }


    $(document).ready(function(){
        new changeForm();
    });
