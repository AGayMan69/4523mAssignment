var dp=$("#datepicker").datepicker( {
    format: "yyyy-mm",
    startView: "months",
    minViewMode: "months",
    defaultDate: new Date()
});
dp.on("changeDate", function(e) {
    //Call ajax when date change
    ajax(e.format());
});

$(document).ready(function() {
    //Set datepicker to today when page ready
    var currentDate = new Date();
    $("#datepicker").datepicker("setDate", currentDate);
});

//Ajax to get report date from retrieveReport.php
function ajax(date){
    var targetDate = date;

    $.ajax({
        type: 'GET',
        url: 'retrieveReport.php',
        data: { selectDate: targetDate },
        dataType:'json',
        success: function(result) {
            GetReportDate(targetDate);

            if ( $( "#reportSection" ).length ) {
                const element = document.getElementById('reportSection');
                element.remove();
            }

            let htmlEle = document.createElement('section');
            htmlEle.id='reportSection';

            for(const k in result) {
                htmlEle.innerHTML+=getStaffCard(result[k]);
            }
            $('#mainContainer').append(htmlEle);
        }
    });
}

//Insert employee report data to Card html
function getStaffCard(result){
    var staffID = result.staffID;
    var staffName = result.staffName;
    var NoOfOrder = result.NoOfOrder;
    var OrderAmount = result.OrderAmount;

    //console.log((NoOfOrder/100)*100);
    $htmlString = '<div class="staff-card row my-5 shadow-lg p-5 bg-dark text-light rounded-5"><div class="col-md-6"><div class="row justify-content-md-start justify-content-center" style="padding: 0; margin: 0"><img src="https://randomuser.me/api/portraits/men/'+Math.floor(Math.random() * 10)+'.jpg" class="rounded-circle col-12 mb-4 shadow" alt="" style="max-width: 12em; padding: 0">\n' +
        '<div class="col-12 display-5 text-nowrap mb-2 text-md-start text-center" style="padding: 0">'+staffName+'</div><div class="col-12 fs-5 fw-light text-nowrap text-md-start text-center" style="padding: 0">Staff ID: '+staffID+'</div></div></div><div class="col"><div class="row mt-4 mb-5"><div class="col-12" style="padding: 0"><div class="row">\n' +
        '<div class="col-auto fs-5 fw-light" style="padding: 0">Number Of Orders: </div><div class="col-auto ms-auto fs-5 text-warning fw-semibold" style="padding: 0">'+NoOfOrder+'</div><div class="w-100"></div>\n' +
        '<div class="progress mt-3" style="max-width: 100%; padding: 0">\n' +
        '<div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: '+(NoOfOrder/100)*100+'%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div></div></div></div></div>\n' +
        '<div class="row mt-5"><div class="col-12" style="padding: 0"><div class="row"><div class="col-auto fs-5 fw-light" style="padding: 0">\n' +
        'Total Sales Amount: </div><div class="col-auto ms-auto fs-5 text-warning fw-semibold" style="padding: 0">$'+OrderAmount+'</div><div class="w-100"></div><div class="progress mt-3" style="max-width: 100%; padding: 0"><div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" style="width:'+(OrderAmount/100000)*100+'%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div></div></div></div></div></div></div>'

    return $htmlString;
}

//Get Current year and month
function GetReportDate(date){
    //display-3
    var dt = new Date(date);
    var month = ["January","February","March","April","May","June","July","August","September","October","November","December"];
    document.getElementsByClassName('display-3')[0].innerText= "Monthly Report "+dt.getFullYear() + "-" + month[(dt.getMonth())];
}







