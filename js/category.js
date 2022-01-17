$(document).ready(function () {
  $("#categoryFrom").submit(function (e) {
    
       var data= $("#Acategory").val()
       if(data=="")
       {
         $("#span_error").html("Required");   
         
       }else{
            $("#span_error").html("");
 var existingEntries = JSON.parse(localStorage.getItem("categories"));
    if(existingEntries == null) existingEntries = [];
    localStorage.setItem("entry", data);
    // Save categories back to local storage
    existingEntries.push(data);
    localStorage.setItem("categories", JSON.stringify(existingEntries));
     jQuery("#categoryFrom")["0"].reset();
    callme();
    //  $("#category_list").html(a.toString().split("'"));
       }
        e.preventDefault();
       
       
  });
  const badge = [
    "badge bg-primary",
    "badge bg-secondary",
    "badge bg-success",
    "badge bg-danger",
    "badge bg-info",
    "badge bg-warning",
  ];
function getRandomItem(arr) {

    // get random index value
    const randomIndex = Math.floor(Math.random() * arr.length);

    // get random item
    const item = arr[randomIndex];

    return item;
}
const result = getRandomItem(badge);

function callme(param) {
  let display = "";
  let selectCategory = "<option selected disabled>Add to Select</option>";
  const Cate_data = JSON.parse(localStorage.getItem("categories"));
  for (var i = 0; i < Cate_data.length; i++) {
    //  //console.log(Cate_data[i]);
    display += `<span class="${result} text-white">${Cate_data[i]}<span onclick="remove(${i})"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
</svg></span></span>&nbsp;`;
    selectCategory += `<option value="${Cate_data[i]}">${Cate_data[i]}</option>`;
  }

  $("#list_categories").html(display);
  $("#select_category").html(selectCategory);
}
// });
callme();



});
function remove(index) {
  const Cate_data = JSON.parse(localStorage.getItem("categories"));
  Cate_data.splice(index, 1);
  localStorage.setItem("categories", JSON.stringify(Cate_data));
   $.getScript("js/category.js", function () {
     // //console.log("Added");
   });
}
   

