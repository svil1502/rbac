

$('#bills-id_contract').append('<option selected disabled>Выбрать номер договора</option>') ;

function GetData()
{
    var id=document.getElementById("bills-id_contract").value; //id договора
    // получаем индекс выбранного элемента
    var selind = document.getElementById("bills-id_act").options.selectedIndex;
    var id_cat= document.getElementById("bills-id_act").options[selind].id; //contract_id
    var txt= document.getElementById("bills-id_act").options[selind].text; //номер акта
    var val= document.getElementById("bills-id_act").options[selind].value; //act_id
    var col=document.getElementById("bills-id_act").length; //количество актов в select
   // console.log("bills-id_contract= ", id ," selind=" , selind, "id_cat=", id_cat, "txt= " ,txt+",val="+val+",col=",col);
    var i=0;
    while (i<col) {

        //var per = document.getElementById("product-brand_id").options[i].value; //берем id акта
        var per= document.getElementById("bills-id_act").options[i].id; // берем id договора
        if (id == per) {
            document.getElementById("bills-id_act")[i].style.display = 'block';


        } else {
            document.getElementById("bills-id_act")[i].style.display = 'none';
        }
     //   console.log(i, id, val, document.getElementById("bills-id_act").options[i].value);
        i++;

    }

   //console.log("Теxt= "+ txt +" " + "Value= " + val);
   // console.log( "количество элементов= " + document.getElementById("bills-id_act").length);
}

GetData();

function Selected(a) {
    //document.getElementById('bills-id_act').value = '';
    GetData();

}
