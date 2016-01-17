$(document).ready(function(){
    var requests = $('#requests');
    if(requests.length){
        var data = requests.DataTable({
            searching: false,
            ordering:  false,
            paging: false
        });
        //data.on('select',function (e,dt,type,indexes){
        //    if(type === 'rows'){
        //        console.log('Fire select row');
        //    }
        //});
    }
});
