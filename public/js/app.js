//images upload
const fileInput = document.getElementById('image');

if(fileInput){
    fileInput.addEventListener('change', onFileUploadInputchange)
}

function onFileUploadInputchange()
{
    const fileInputLabel = document.getElementById('imageLabel');
    const fileName = this.value.split('\\').pop();
    fileInputLabel.innerText = fileName;
}

//categories fetsh
let categoryId = 0;
window.addEventListener("load", categoryFetsh);

function categoryFetsh(){
    let editBtns = document.querySelectorAll('.updateBtn');
    editBtns.forEach(element => {
        element.addEventListener('click', editCategory.bind(element));
    });

    let deleteBtns = document.querySelectorAll('.deleteBtn');
    deleteBtns.forEach(element=>{
        element.addEventListener('click', onDeleteClicked.bind(element));
    })
}

function addCategorySubmit(){
    const groupeNameInput = document.getElementById('groupeName');
    const groupeName = groupeNameInput.value;
    data = {groupeName: groupeName};

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: "POST",
        url: '/api/categories',
        data: data,
        success: function() {
             location.reload();
        },
        error: function(xhr, status, error){
            var errorMessages = xhr.responseJSON.errors;
            console.log(errorMessages.groupeName[0]);

        }
      });
}

function editCategory()
{
    const updateForm = document.getElementById('updateCategoryForm')
    const categoryName = updateForm.querySelector('#groupeName');
    console.log(this);
    categoryId = this.dataset.id;

    if(categoryId){
        $.get("/api/categories/"+categoryId, function(data, status){
            if(status === 'success'){
                categoryName.value = data.groupeName;
            }
          });
    }
}

function editCategorySubmit(){
    const updateForm = document.getElementById('updateCategoryForm')
    const categoryName = updateForm.querySelector('#groupeName');
    const groupeName = categoryName.value;
    data = {groupeName: groupeName};
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: "PUT",
        url: '/api/categories/'+categoryId,
        data: data,
        success: function() {
             location.reload();
        },
        error: function(xhr, status, error){
            var errorMessages = xhr.responseJSON.errors;
            console.log(errorMessages.groupeName[0]);

        }
      });
}

function onDeleteClicked(){
    categoryId = this.dataset.id;
}

function confirmDeleteClicked(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: "DELETE",
        url: '/api/categories/'+categoryId,
        success: function() {
             location.reload();
        },
        error: function(xhr, status, error){
            var errorMessages = xhr.responseJSON.errors;
            console.log(errorMessages.groupeName[0]);

        }
      });
}
