 var base_url = $("#base_url").val();
 var url_send = base_url+'user/exam/save_file';
    $("#video_start").on("click",function(){
        alert("hai");
    $("#start").show();
    $(this).hide();
    $("#your-video-id").show();
    $("#audio_start").hide();
         //capture camera and/or microphone
navigator.mediaDevices.getUserMedia({
    video: true,
    audio: true
}).then(function(camera){

    // recording configuration/hints/parameters
    var recordingHints = {
        type: 'video',
        //type: 'audio'
    };

    //initiating the recorder

     var recorder = RecordRTC(camera,recordingHints);

    // starting recording here
     $("#start").on("click",function(){
        $(this).hide();
         $("#stop").show();
            recorder.startRecording();
            document.getElementById('your-video-id').muted = true;
            document.getElementById('your-video-id').srcObject = camera;
        });

    // stop recording 
    $("#stop").on("click",function(){
        $(this).hide();
        $("#save").show();
         recorder.stopRecording(function(){
            var blob = recorder.getBlob();
            //window.open(URL.createObjectURL(blob));

            document.getElementById('your-video-id').srcObject = null;
            camera.getTracks().forEach(function(track) {
                track.stop();
            });

            // you can preview recorded data on this page as well
            document.getElementById('your-video-id').src = URL.createObjectURL(blob);
            var file_data = URL.createObjectURL(blob);

             var fileType = blob.type.split('/')[0] || 'audio';

                var fileName = (Math.random() * 1000).toString().replace('.', '');

                if (fileType === 'audio') {
                    fileName += '.' + (!!navigator.mozGetUserMedia ? 'ogg' : 'wav');
                } else {
                    fileName += '.webm';
                }

                //alert(formData['fileType']);
                 
                var request = new XMLHttpRequest();
                
                // POST to httpbin which returns the POST data as JSON
                request.open('POST', url_send, /* async = */ false);

                var formData = new FormData();
                formData.append(fileType + '-filename', fileName);
                formData.append(fileType + '-blob', blob);
               
                $("#save").on("click",function() {
                   request.send(formData);
                    console.log(request.response);
                });
                
         });
    
    }); // stop button end here
    
}); // navigator.then () end here


}); //video start end

           


var url_send = base_url+'user/exam/save_file';
$("#audio_start").on("click",function(){
    $("#start").show();
    $(this).hide();
    $("#your-video-id").show();
    $("#video_start").hide();
         //capture camera and/or microphone
navigator.mediaDevices.getUserMedia({
    video: false,
    audio: true
}).then(function(camera){

    //recording configuration/hints/parameters
    var recordingHints = {
        type: 'audio',
        //type: 'audio'
    };

    // initiating the recorder

     var recorder = RecordRTC(camera, recordingHints);

    // starting recording here
     $("#start").on("click",function(){
        $(this).hide();
         $("#stop").show();
            recorder.startRecording();
            document.getElementById('your-video-id').muted = true;
            document.getElementById('your-video-id').srcObject = camera;
        });

    // stop recording 
    $("#stop").on("click",function(){
        $(this).hide();
        $("#save").show();
         recorder.stopRecording(function(){
            var blob = recorder.getBlob();
            //window.open(URL.createObjectURL(blob));

            document.getElementById('your-video-id').srcObject = null;
            camera.getTracks().forEach(function(track) {
                track.stop();
            });

            //you can preview recorded data on this page as well
            document.getElementById('your-video-id').src = URL.createObjectURL(blob);
            var file_data = URL.createObjectURL(blob);

             var fileType = blob.type.split('/')[0] || 'audio';

                var fileName = (Math.random() * 1000).toString().replace('.', '');

                if (fileType === 'audio') {
                    fileName += '.' + (!!navigator.mozGetUserMedia ? 'ogg' : 'wav');
                } else {
                    fileName += '.webm';
                }

                //alert(formData['fileType']);
                 
                var request = new XMLHttpRequest();
               
                //POST to httpbin which returns the POST data as JSON
                request.open('POST', url_send, /* async = */ false);

                var formData = new FormData();
                formData.append(fileType + '-filename', fileName);
                formData.append(fileType + '-blob', blob);
               
                $("#save").on("click",function(){
                   request.send(formData);
                    console.log(request.response);
                });
                
         });

    
    }); // stop button end here
    
}); // navigator.then () end here


}); //video start end

     