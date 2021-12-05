// Hien thi thong bao
function showAlertBuy(arr,time) {
    if(arr.length > 0){
        toastr.success(arr[0])
        var index = 1;
        setInterval(function(){
            if(index == arr.length){
                toastr.success(arr[0]);
                index = 1;
            }
            toastr.success(arr[index++ % arr.length]);
        }, time);
    }

}
//Ket noi google sheet
var arrNotify = [];
function readNotifyExcel(file,time){
    Papa.parse(file, {
        download: true,
        step: function(row) {
            if(row.data.length == 2 && Number.isInteger(parseInt(row.data[0]))){
                arrNotify.push(row.data[1]);
            }
        },
        complete: function() {
            // console.log("Read done!");
            // console.log(arrNotify);
            showAlertBuy(arrNotify,time);
        },
        error: function(err, file, inputElem, reason){
            console.log("ERROR:", err, file);
        },
    });

}

// Goi ham readNotifyExcel('lien ket toi file','thoi gian hien thi(mili giay)')
var linkExcel = 'https://docs.google.com/spreadsheets/d/1ddg8ucQN8zmD-fx6r8nZOoogwsXkSVPNO__Z3InBloE/edit?usp=sharing';
var time = 10000;
readNotifyExcel(linkExcel,time);


