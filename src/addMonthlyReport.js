$(document).ready(function (){
    $.ajax({
        type:'POST',
        url:'retrieveReport.php',
        dataType: 'json',
        success: function (result){ //Array
            // for(i=0; i<result.length;i++ ){
            //     console.log(result[i].staffID);
                // $txt = '<div>'+result[i].staffID+'</div>';
                // console.log($txt);
                // $('#mainContainer').append($htmlString);
            // }
            for(var k in result) {
                console.log(k, result[k]);
                console.log(result[k][1]);
                $('#mainContainer').append(getStaffCard(result[k][0],result[k][1],result[k][2],result[k][3]));
                console.log(result[k][2]/100);
            }
        }
    });
});

function getStaffCard(staffID,staffName,NoOfOrder,OrderAmount){

    $htmlString = '<div class="staff-card row my-5 shadow-lg p-5 bg-dark text-light rounded-5"><div class="col-md-6"><div class="row justify-content-md-start justify-content-center" style="padding: 0; margin: 0"><img src="https://randomuser.me/api/portraits/men/'+Math.floor(Math.random() * 10)+'.jpg"class="rounded-circle col-12 mb-4 shadow" alt=""style="max-width: 12em; padding: 0">\n' +
        '<div class="col-12 display-5 text-nowrap mb-2 text-md-start text-center" style="padding: 0">'+staffName+'</div><div class="col-12 fs-5 fw-light text-nowrap text-md-start text-center" style="padding: 0">Staff ID: '+staffID+'</div></div></div><div class="col"><div class="row mt-4 mb-5"><div class="col-12" style="padding: 0"><div class="row">\n' +
        '<div class="col-auto fs-5 fw-light" style="padding: 0">Number Of Orders: </div><div class="col-auto ms-auto fs-5 text-warning fw-semibold" style="padding: 0">'+NoOfOrder+'</div><div class="w-100"></div>\n' +
        '<div class="progress mt-3" style="max-width: 100%; padding: 0">\n' +
        '<div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: '+(NoOfOrder/100)+'%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div></div></div></div></div>\n' +
        '<div class="row mt-5"><div class="col-12" style="padding: 0"><div class="row"><div class="col-auto fs-5 fw-light" style="padding: 0">\n' +
        'Total Sales Amount: </div><div class="col-auto ms-auto fs-5 text-warning fw-semibold" style="padding: 0">$'+OrderAmount+'</div><div class="w-100"></div><div class="progress mt-3" style="max-width: 100%; padding: 0"><div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" style="width:'+(OrderAmount/10000)+'%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div></div></div></div></div></div></div>'

    return $htmlString;
}







