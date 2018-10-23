/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//$("#img").change(function (){
//    alert('Hello'); 
//});

//---------------- Upload img in personal info ------------
function changeProfile() {
    $('#img').click();
}
$('#img').change(function () {
    if ($(this).val() != '') {
        upload(this);
    }
});
 