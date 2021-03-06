         window.URL = window.URL || window.webkitURL;

        document.addEventListener('DOMContentLoaded', function(){
            var select_images_input = document.getElementById("select_images_input"),
                th_container = document.getElementById("th_container"),
                btn_scan = document.getElementById("btn-scan"),
                //btn_sources = document.getElementById("btn-sources"),
                download_app = document.getElementById("download-app"),
                btn_upload = document.getElementById("btn-upload");

            var i = 0;
            var wsImpl = window.WebSocket || window.MozWebSocket;
            window.ws = new wsImpl('wss://' + currentClientIp + ':4000');
            ws.onmessage = function(e){
                if(e.data == "EnableScan"){
                    $("#btn-scan").show();
                }else if(e.data instanceof Blob){
                                    
                    i++;
                    if(document.getElementById("th_container_empty") != null){
                        document.getElementById("th_container_empty").style.display = 'none';
                    }
                    var th_img_id = "upl_image" + i;
                    createThumbnail(th_container, th_img_id, "Scan "+i);
                    appendImage(e.data, th_img_id);
                    as.btn.stopLoading($("#btn-scan"));
                    $("#btn-scan").hide();
                    $("#scannerUploader .actions a[href='#next']").parent().attr('aria-disabled',false).removeClass('disabled');
                
                } else {
                
                    var data = e.data.split(",");
                    createSources(data);
                }

            };
            



            /* Create Sources DropDown */
            function createSources(sources){
                console.log(sources);
                if(sources.length > 0){
                    for(var i = 0; i < sources.length; i++) {
                        var parts = sources[i].split(':value');
                        var id = parts[parts.length - 1];
                        var name = parts[0];
                       $('#sources-list').append('<option value='+id+'>'+name+'</option>');
                    }
                }
            }
            

            /* Logic to do when dropdown scanner change */
            $("#sources-list").on('change',function(e){
                $("#btn-scan").hide();
                $("#scannerUploader .actions a[href='#next']").parent().attr('aria-disabled',true).addClass('disabled');
                if($(".th_remove").length > 0){
                    $(".th_remove").click();
                } 
                var selectedSource =  $(this).find('option:selected').val();
                ws.send(JSON.stringify({message:"1300",source:selectedSource}));
            });


            ws.onopen = function(){
                btn_scan.removeAttribute('disabled');
                download_app.style.display = 'none';
                as.btn.stopLoading($("#btn-scan"));

                /* Load Scanners List on document load */ 
                $('#sources-list').html('<option disabled selected>S??lectionner un scanner</option>')
                    ws.send(JSON.stringify({message:"1200"}));
                /* Load Scanners List on document load */ 

            };
            ws.onerror = function(e){
                btn_scan.setAttribute('disabled', '');
                as.btn.stopLoading($("#btn-scan"));
                download_app.style.display = '';
            }

            $("#btn-scan").on('click',function(e){
                as.btn.loading($("#btn-scan"),btnScanningText);
                ws.send(JSON.stringify({message:"1100"}));
            })
            /*btn_scan.addEventListener('click', function(){

            }, false);*/
            
            /*btn_sources.addEventListener('click', function(){
                $('#sources-list').html('<option disabled selected>S??lectionner un scanner</option>')
                    ws.send(JSON.stringify({message:"1200"}));
            }, false);*/




            $("#btn-upload").on('click',function(e){
                btn_upload.style.display = 'none';
                Array.from(document.querySelectorAll("img.th_img")).forEach(e => { uploadImage(e); });
            })


        });

        document.addEventListener('click',function(e){
            if (e.target && e.target.className == 'th_rotate') {
                var c = document.createElement('canvas');
                var ctx = c.getContext('2d');
                var src_img = e.target.previousElementSibling;
                var img = new Image();
                img.src = src_img.src;
                img.onload = function() {
                    imgWidth = img.width;
                    imgHeight = img.height;
                    c.width = imgHeight;
                    c.height = imgWidth;
                    ctx.translate(c.width/2, c.height/2);
                    ctx.rotate(90*Math.PI/180);
                    ctx.translate(-c.height/2, -c.width/2);
                    ctx.drawImage(img, 0, 0);
                    c.toBlob(function(blob){
                        window.URL.revokeObjectURL(src_img.src);
                        src_img.src = window.URL.createObjectURL(blob);
                    }, "image/jpeg", 0.9);
                }
            }
        });

        function createThumbnail(container, th_img_id, caption){
            var col = document.createElement("div");
            col.className = "col-md-12";
            container.appendChild(col);

            var th = document.createElement("div");
            th.className = "card mb-4 shadow-sm text-center";
            col.appendChild(th);

            var th_img = document.createElement("img");
            th_img.style.width='360px';
            th_img.className = "card-img-top th_img";
            th_img.id = th_img_id;
            th_img.width = 360;
            th.appendChild(th_img);

            /*var th_rotate = document.createElement("div");
            th_rotate.className = "th_rotate";
            th.appendChild(th_rotate);*/



            var prg = document.createElement("div");
            prg.className = "progress th_progress";
            prg.innerHTML = "<div class=\"progress-bar bg-warning\" role=\"progressbar\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>";
            th.appendChild(prg);

            var th_remove = document.createElement("button");
            th_remove.className = "close text-danger th_remove";
            th_remove.setAttribute("type", "button");
            th_remove.setAttribute("aria-label", "Remove");
            th_remove.innerHTML = "<span aria-hidden=\"true\">&times;</span>";
            th.appendChild(th_remove);

            th_remove.addEventListener("click", function(e){
                e.target.parentNode.parentNode.remove();
                $("#btn-scan").show();
                $("#scannerUploader .actions a[href='#next']").parent().attr('aria-disabled',true).addClass('disabled');
            }, false);
        }

        function appendImage(file, img_id, maxSizeWH = 3000){
            function calculateAspectRatioFit(srcWidth, srcHeight, maxWidth, maxHeight) {
                var ratio = [maxWidth / srcWidth, maxHeight / srcHeight ];
                ratio = Math.min(ratio[0], ratio[1]);
                return { width:srcWidth*ratio, height:srcHeight*ratio };
            }
            var img = new Image();
            img.src = window.URL.createObjectURL(file);
            img.onload = function(){
                var c = document.createElement('canvas');
                if ((this.naturalWidth < maxSizeWH) && (this.naturalHeight < maxSizeWH)){
                    var new_dimensions = {width:this.naturalWidth, height:this.naturalHeight};
                }else{
                    var new_dimensions = calculateAspectRatioFit(this.naturalWidth, this.naturalHeight, maxSizeWH, maxSizeWH);
                }
                c.width = new_dimensions.width;
                c.height = new_dimensions.height;
                c.getContext('2d').drawImage(this, 0, 0, this.naturalWidth, this.naturalHeight, 0, 0, new_dimensions.width, new_dimensions.height);
                c.toBlob(function(blob){
                    document.getElementById(img_id).src = window.URL.createObjectURL(blob);
                }, "image/jpeg", 0.9);
                c.remove();
            }
            img.remove();

        }

        function uploadImage(src_img){
            fetch(src_img.src).then(i=>i.blob()).then(function(imageBlob){
                scannerForm = document.getElementById('scanner-form');
                var fd = new FormData(scannerForm);
                fd.append("type", "image_upload");
                fd.append("blob", imageBlob);
                var xhr = new XMLHttpRequest();
                xhr.addEventListener("loadstart", function(e){
                    var siblings = [].slice.call(src_img.parentNode.children) // convert to array
                        .filter(function(v) { return v !== src_img }) // remove element itself
                        .forEach(function(el){
                            if (el.className == "th_rotate" || el.className == "close th_remove") el.remove();
                            if (el.className == "progress th_progress") el.style.display = "flex";
                        });
                }, false);
                xhr.upload.addEventListener("progress", function(e) {
                    if (e.lengthComputable) {
                        var percentage = Math.round((e.loaded*100)/e.total);
                        src_img.nextSibling.nextSibling.firstChild.style.width = percentage+'%';
                        src_img.nextSibling.nextSibling.firstChild.setAttribute("aria-valuenow", percentage);
                    }
                }, false);
                xhr.onreadystatechange = function(){
                    if (xhr.readyState == 4){
                        if(xhr.status == 200){
                            as.btn.stopLoading($("#scannerUploader .actions a[href='#finish']"));
                            window.location.href = redirectAfterUpload;
                        }else{
                            $("#uploadServerError").show();
                            as.btn.stopLoading($("#scannerUploader .actions a[href='#finish']"));
                        }
                    }
                }
                xhr.open("POST", filesScannerRoute);
                xhr.overrideMimeType('text/plain; charset=x-user-defined-binary');
                xhr.send(fd);
            });
}
