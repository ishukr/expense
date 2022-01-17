$.ajax({
  type: "get",
  url: "payroll.php",
  dataType: "json",
})
  .done(function (response) {
    //console.log(response);
    let displaytable = "";
    var Mcount = 0,
      Fcount = 0,
      WDcount = 0,
      ADcount = 0,
      Dcount = 0,
      MaCount = 0;

    for (let i = 0; i < response.length; i++) {
      if (response[i].gender == "Male") {
        Mcount += 1;
      } else {
        Fcount += 1;
      }
      if (response[i].jobrole == "Web Developer") {
        WDcount += Number(response[i].salary);
      } else if (response[i].jobrole == "App Developer") {
        ADcount += Number(response[i].salary);
      } else if (response[i].jobrole == "Designer") {
        Dcount += Number(response[i].salary);
      } else if (response[i].jobrole == "Marketing") {
        MaCount += Number(response[i].salary);
      }
      $("#ECount").html(Mcount + Fcount);
      $("#MCount").html(Mcount);
      $("#FCount").html(Fcount);
      $("#WDcount").html(WDcount);
      $("#ADcount").html(ADcount);
      $("#Dcount").html(Dcount);
      $("#MaCount").html(MaCount);

      displaytable += ` <tr>
                        <td>${response[i].employeeCode}</td>
                         <td>${response[i].empname}</td>
                          <td>${response[i].region}</td>
                            <td>${response[i].jobrole}</td>
                           <td>${response[i].jobTitleName}</td>
                            <td><i class="fas fa-rupee-sign"></i>&nbsp;${
                              response[i].salary
                            }</td>
                             <td>${
                               response[i].pay_status === "0"
                                 ? '<span class="badge bg-danger text-white">Pending</span>'
                                 : '<span class="badge bg-success text-white">Paid</span>'
                             }</td>
                            <td>&nbsp;${response[i].dop}</td>
                           
                            <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                            ${
                              response[i].pay_status === "0"
                                ? `<a href="payslip.php" class="btn btn-success "  aria-current="page" onclick="payslip
                          ( '${response[i].employeeCode}',
                            '${response[i].empname}','${response[i].jobrole}',
                            '${response[i].jobTitleName}','${response[i].salary}',
                            '${response[i].accno}','${response[i].region}',
                            '${response[i].phoneNumber}','${response[i].emailAddress}')"> <i class="fas fa-eye"></i>Pay</a>`
                                : ``
                            }
                            
                            <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-info" onclick="loademployee
                          ( '${response[i].employeeCode}',
                            '${response[i].empname}','${response[i].jobrole}',
                            '${response[i].jobTitleName}','${
        response[i].salary
      }',
                            '${response[i].accno}','${response[i].gender}',
                            '${response[i].phoneNumber}','${
        response[i].emailAddress
      }')"
                             aria-current="page"> <i class="fas fa-eye"></i>View</a>
                             </div>
                        </td>
                      </tr>`;
    }

    $("#display_data").html(displaytable);
  })
  .fail(function (data) {});
function loademployee(
  params1,
  params2,
  params3,
  params4,
  params5,
  params6,
  params7,
  params8,
  params9
) {
  const data = `<h4 class="mb-0 mt-0">${params2}<sup>${params1}<sup></h4> 
   <span class="text-uppercase">${params3}</span><br>
                     <span>Email:${params9}</span><br>
                     <span class="text-upper">Phno: ${params8}</span><br>
   <span class="text-upper">Position: ${params4}</span><br>
   <span class="text-upper">Salary:<i class="fas fa-rupee-sign"></i>&nbsp;${params5}</span><br>`;
  $("#informationemp").html(data);
}
function payslip(
  params1,
  params2,
  params3,
  params4,
  params5,
  params6,
  params7,
  params8,
  params9
) {
  var dataLoad = {
    params1: params1,
    params2: params2,
    params3: params3,
    params4: params4,
    params5: params5,
    params6: params6,
    params7: params7,
    params8: params8,
    params9: params9,
  };
  sessionStorage.setItem("EmployeDetails", JSON.stringify(dataLoad));
}
function fetch_profile() {
  var payload = localStorage.getItem("Orgpayload");
  var dataProfile = {
    functionName: "viewProfle",
    username: JSON.parse(payload).username,
  };
  $.ajax({
    type: "get",
    url: "dashboard.php",
    data: dataProfile,
    dataType: "json",
    success: function (response) {
      //console.log(response);
      let passdata = ` <h4 class="mb-0 mt-0">${response[0].name}<sup>${response[0].username}<sup></h4> <span class="text-uppercase">${response[0].role}</span><br>
                     <span>${response[0].email}</span>`;
      $("#information").html(passdata);
      $("#output").attr("src", `upload/${response[0].profile}`);
      $("#upperDP").attr("src", `upload/${response[0].profile}`);
    },
    error: function (param) {
      //console.log(param);
    },
  });
}
fetch_profile();
