jQuery(document).ready(function($) {
    //<input multiple accept = "image/png" type="file" id="file"/>
	document.getElementById('file').addEventListener('change', readURL_multi, false);

    //<button id='file_upload'>確認上傳</button>
    //傳至伺服器端
    $('#file_upload').click(function(event){
        event.preventDefault();//阻擋預設跳轉

        //計算實際上傳檔案
        var total = 0;
        for(var i = 0; i < multi.length; i++){
            if(multi[i] != 'removed')
                total++;
        }

        console.log(total);
        //上傳檔案，異步
        var count = 0;
        var filename = "";
        for(var i = 0; i < multi.length; i++){
            //console.log(i);
            if(multi[i] != 'removed'){
                var fd = new FormData();
                fd.append('file',multi[i]);//伺服器端接收：$_FILES["file"]["tmp_name"]
                $.ajax({
                    url: './_upload.php',
                    type: 'POST',
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function(data){
                        if(data != false){
                            if(filename != ""){
                                filename = filename+","+data;
                                console.log(filename);
                            }
                            else{
                                filename = data;
                            }
                            console.log(filename);
                        }
                    },
                    error:function(){
                        console.log("OOPS!");
                    }
                })
                .done(function(){
                    count++;
                    if(count == total){
                        $('#filename').val(filename);
                        //alert('檔案全數上傳完成');
                        //$('#submit').trigger("click");
                    }
                });
            }
        }
        if(total == 0)
            $('#submit').trigger("click");
    });
});

var multi = Array();//儲存照片用
var index_multi = 0;//避免重複預覽
function readURL_multi(input) {
    if (input.target.files && input.target.files[0]){
        var length = input.target.files.length;
        var seq = 0;

        var reader = new FileReader();
        reader.onload = function (e) {

            var data = e.target.result.split(',')[1];
            data = window.atob(data);
            var ia = new Uint8Array(data.length);
            for (var i = 0; i < data.length; i++) {
                ia[i] = data.charCodeAt(i);
            };
            var temp = new Blob([ia], {type:"image/png"});

            multi.push(temp);
            seq++;
            if(seq < length)
                reader.readAsDataURL(input.target.files[seq]);
            else
                output();
        }

        reader.readAsDataURL(input.target.files[seq]);
    }
    function output(){
        $('.clearboth').remove();//<br class="clearboth" style="clear:both;">，避免超出版面用
        for(var i = index_multi; i < multi.length; i++){
            if(multi[i] != 'removed'){
                var urlCreator = window.URL || window.webkitURL;
                var imageUrl = urlCreator.createObjectURL(multi[i]);
                $('.preview').append('<div class="col-md-3 col-xs-3">'
                                        +'<div class="cancel" title="移除">&#10006;</div>'
                                        +'<img class="upload_pics_'+i+'" src="'+imageUrl+'" style="height: 100px;">'
                                    +'</div>');
                $('.cancel').bind('click', function(event){
                    var seq = $(this).next('img').attr('class');
                    seq = seq.slice(12);
                    multi.splice(seq,1,'removed');
                    $(this).parent('div').remove();
                    $(this).bind('click', function(event) {
                        /* Act on the event */
                    });
                });
            }
        }
        $('.preview').append('<br class="clearboth" style="clear:both;">');
        index_multi = multi.length;
    }
    /*
    <div class="preview">
        <div>
            <div class="cancel" title="移除">&#10006;</div>
            <img class="upload_pics_[流水號]" src="[暫存位置]">
        </div>
        <br class="clearboth" style="clear:both;">
    </div>
    */
}