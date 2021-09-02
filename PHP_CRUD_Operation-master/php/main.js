
let id = $("input[name*='product_id']")
id.attr("readonly","readonly");


$(".btnedit").click( e =>{
    let textvalues = displayData(e);

    ;
    let productname = $("input[name*='product_name']");
    let productdesc = $("input[name*='product_desc']");
    let productprice = $("input[name*='product_price']");

    id.val(textvalues[0]);
    productname.val(textvalues[1]);
    productdesc.val(textvalues[2]);
    productprice.val(textvalues[3].replace("$", ""));
});


function displayData(e) {
    let id = 0;
    const td = $("#tbody tr td");
    let textvalues = [];

    for (const value of td){
        if(value.dataset.id == e.target.dataset.id){
           textvalues[id++] = value.textContent;
        }
    }
    return textvalues;

}