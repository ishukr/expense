<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Payslip</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />

  <link rel="stylesheet" href="css/payslip.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="./vendor/jquery/jquery.min.js"></script>
  <!-- <script src="js/org/dashboard.js"></script> -->
  <script>
    function NumInWords(number) {
      const first = ['', 'one ', 'two ', 'three ', 'four ', 'five ', 'six ', 'seven ', 'eight ', 'nine ', 'ten ', 'eleven ', 'twelve ', 'thirteen ', 'fourteen ', 'fifteen ', 'sixteen ', 'seventeen ', 'eighteen ', 'nineteen '];
      const tens = ['', '', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];
      const mad = ['', 'thousand', 'million', 'billion', 'trillion'];
      let word = '';

      for (let i = 0; i < mad.length; i++) {
        let tempNumber = number % (100 * Math.pow(1000, i));
        if (Math.floor(tempNumber / Math.pow(1000, i)) !== 0) {
          if (Math.floor(tempNumber / Math.pow(1000, i)) < 20) {
            word = first[Math.floor(tempNumber / Math.pow(1000, i))] + mad[i] + ' ' + word;
          } else {
            word = tens[Math.floor(tempNumber / (10 * Math.pow(1000, i)))] + '-' + first[Math.floor(tempNumber / Math.pow(1000, i)) % 10] + mad[i] + ' ' + word;
          }
        }

        tempNumber = number % (Math.pow(1000, i + 1));
        if (Math.floor(tempNumber / (100 * Math.pow(1000, i))) !== 0) word = first[Math.floor(tempNumber / (100 * Math.pow(1000, i)))] + 'hunderd ' + word;
      }
      return word;
    }

    $(document).ready(function() {
      var EmpDetails = JSON.parse(sessionStorage.getItem('EmployeDetails'));
      //console.log(EmpDetails);
      $("#empid").html(EmpDetails.params1);
      $("#empname").html(EmpDetails.params2);
      $("#empRegion").html("Region:" + EmpDetails.params7);
      $("#phno").html("+91 " + EmpDetails.params8);
      $("#emprole").html(EmpDetails.params3);
      $("#empPos").html(EmpDetails.params4);
      $("#accno").val(EmpDetails.params6);
      $("#basicsalary").html(EmpDetails.params5);

      var hra = Math.floor(Math.random() * (10000 - 5000 + 1)) + 5000;
      var ca = Math.floor(Math.random() * (4000 - 3000 + 1)) + 3000;
      var bonus = Math.floor(Math.random() * (5000 - 0 + 1)) + 0;
      var pf = Math.floor(Math.random() * (3000 - 2000 + 1)) + 2000;
      var pt = Math.floor(Math.random() * (3000 - 2000 + 1)) + 2000;
      var it = Math.floor(Math.random() * (3000 - 0 + 1)) + 0;
      var total = Number(EmpDetails.params5) + hra + ca + bonus - pf - pt - it;

      $("#total").html(total + " /-")
      var numInWords = NumInWords(total);
      $("#numintext").html(numInWords + " Only/-");





      $("#hra").html(hra);
      $("#ca").html(ca);
      $("#bonus").html(bonus);
      $("#pf").html(pf);
      $("#pt").html(pt);
      $("#it").html(it);





    });

    function handlebank(params) {
      if (params === "sbi") {

        $("#orgaccno").val("45330445760")
      } else if (params === "hdfc") {
        $("#orgaccno").val("34231445768")
      }

    }
  </script>
</head>

<body>
  <div class="container">
    <div class="row m-0">
      <div class="col col-12">
        <div class="box-left">
          <p class="textmuted h8">Invoice</p>
          <p class="textmuted fw-bold h6 mb-0">Employee Id: <span id="empid"></span> </p>
          <p class="fw-bold h7"><span id="empname"></span></p>
          <p class="fw-bold h7"><span id="emprole"></span><sup><span id="empPos"></span></sup></p>
          <p class="textmuted h8" id="phno"></p>
          <p class="textmuted h8 mb-2" id="empRegion"></p>
          <p class="ms-3 px-2 bg-green" id="working">+10% since last month</p>
          <div class="h8">
            <table class="table table-striped">
              <thead>
                <th scope="col">#</th>
                <th scope="col"></th>
                <th scope="col">Earnings</th>
                <th scope="col">Deductions</th>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">1</th>
                  <td>Basic Salary</td>
                  <td id="basicsalary"></td>
                  <td>-</td>
                </tr>
                <tr>
                  <th scope="row">2</th>
                  <td>House Rent Allowance (H.R.A.)</td>
                  <td id="hra"></td>
                  <td>-</td>
                </tr>
                <tr>
                  <th scope="row">3</th>
                  <td>Conveyance allowance</td>
                  <td id="ca">1000</td>
                  <td>-</td>
                </tr>
                <tr>
                  <th scope="row">4</th>
                  <td colspan="1">Bonus</td>
                  <td id="bonus"></td>
                  <td>-</td>
                </tr>
                <tr>
                  <th scope="row">5</th>
                  <td colspan="2">Provident Fund</td>
                  <td id="pf">1929</td>
                </tr>
                <tr>
                  <th scope="row">6</th>
                  <td colspan="2">Professional Tax</td>
                  <td id="pt"></td>
                </tr>
                <tr>
                  <th scope="row">7</th>
                  <td colspan="2">Income Tax</td>
                  <td id="it"></td>
                </tr>
              </tbody>
            </table>
            <div class="d-flex h7 mb-2">
              <p class="">Total Amount:</p>
              <p class="ms-2">
                <span class="fas fa-rupee-sign"></span>
                <span id="total"></span>
              </p>
            </div>
            <div class="h4 mb-5">
              <p class="textmuted text-uppercase" id="numintext"></p>
            </div>
          </div>
          <div class="">
            <p class="h7 fw-bold mb-1">Pay this Invoice</p>
            <p class="textmuted h8 mb-2">
              Make payment for this invoice by filling in the details
            </p>
            <div class="form">
              <div class="row">
                <div class="col-12">
                  <div class="card border-0">
                    <input class="form-control ps-5" type="text" placeholder="Account number" id="accno" disabled />
                    <span class="far fa-credit-card"></span>
                  </div>
                </div>
                <div class="col-6 pt-2">
                  <p class="p-blue h8 fw-bold mb-3">Click Bank For the Payment</p>
                  <span class="text-danger h3" id="message"></span>
                  <div class="d-grid gap-2 d-md-block pb-3">
                    <button class="btn btn-light" type="button" onclick="handlebank('sbi')">
                      STATE BANK OF INDIA-SBI
                      <img src="images/sbi.svg" width="50px" height="50px" />
                    </button>
                    <button class="btn btn-light" type="button" onclick="handlebank('hdfc')">
                      HDFC BANK
                      <img src="https://1000logos.net/wp-content/uploads/2021/06/HDFC-Bank-emblem-500x333.png" width="100px" height="60px" />
                    </button>
                  </div>
                  <div class="col-12 mb-4">
                    <div class="card border-0">
                      <form method="post" id="paid">
                        <input class="form-control ps-5" type="text" placeholder="From Account" id="orgaccno" disabled required />
                        <span class="far fa-credit-card"></span>
                    </div>
                  </div>
                </div>

                <button class="btn btn-primary d-block h8">
                  PAY<span class="ms-3 fas fa-arrow-right"></span>
                </button>
                </form>

              </div>


            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
<script>
  $(document).ready(function() {
    $("#paid").submit(function(e) {
      if (!$("#orgaccno").val())
        $("#message").html("Select Bank To Pay")
      else {
        $("#message").html("")
      }
      var EmpDetails = JSON.parse(sessionStorage.getItem('EmployeDetails'));
      var data = {
        status: 1,
        eid: EmpDetails.params1

      }
      $.ajax({
        type: "post",
        url: "pay.php",
        data: data,
        dataType: "json",
        success: function(response) {
          //console.log(response);
          window.location.replace('organisation.php')
        }
      });
      e.preventDefault();
    });




  });
</script>


</html>