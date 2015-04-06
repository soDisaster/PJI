function test(file) {

    function miniatures(file){

        var reader = new FileReader();

            reader.addEventListener('load', function() {

                var imgElement = document.createElement('img');
                imgElement.style.maxWidth = '250px';
                imgElement.style.maxHeight = '250px';
                imgElement.src = this.result;
                min.appendChild(imgElement);

            }, false);

            reader.readAsDataURL(file);
        };


        var allowedTypes = ['png', 'jpg', 'jpeg', 'gif'],
            fileInput = document.querySelector('#file'),
            min = document.querySelector('#min');

        fileInput.addEventListener('change', function() {

            var files = this.files,
                filesLen = files.length,
                imgType;

            for (var i = 0 ; i < filesLen ; i++) {

                imgType = files[i].name.split('.');
                imgType = imgType[imgType.length - 1];

                if(allowedTypes.indexOf(imgType) != -1) {
                    miniatures(files[i]);
                }

            }

        }, false);

};

function dossier(){
  var obj = new ActiveXObject("WScript.Shell" );
  obj.run('explorer.exe /e "//Images"', 0, true);
};
