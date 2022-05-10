window.addEventListener("load", categoryFetsh);

const fileInput = document.getElementById('image');
let categoryId = 0;

if(fileInput){
    fileInput.addEventListener('change', onFileUploadInputchange)
}

function onFileUploadInputchange()
{
    const fileInputLabel = document.getElementById('imageLabel');
    const fileName = this.value.split('\\').pop();
    fileInputLabel.innerText = fileName;
}

function categoryFetsh(){
    const regex = new RegExp('^(/categories)');
    const pathName = window.location.pathname;
    if(regex.test(pathName))
    {
        let datasetList = document.getElementById('dataset-list');
        const template = document.getElementById('dataset-row');
        $.get("/api/categories", function(data, status){
            if(status === 'success'){
                const response = data;
                const categories = response.data;
                for (const category of categories)
                {
                    let datasetRow = template.content.cloneNode(true);
                    let categoryName = datasetRow.getElementById('CategoryName');
                    categoryName.textContent = category.groupeName;
                    let productCntr = datasetRow.getElementById('nbrArticles');
                    productCntr.textContent = category.articles_count+" Peoduit";
                    let editBtn = datasetRow.getElementById('updateBtn');
                    editBtn.dataset.id = category.id;
                    editBtn.addEventListener('click', editCategory)
                    let deleteBtn = datasetRow.getElementById('deleteBtn');
                    deleteBtn.dataset.id = category.id;
                    deleteBtn.addEventListener('click', onDeleteClicked)
                    datasetList.appendChild(datasetRow);
                }
            }
          });
    }
}

function editCategory()
{
    const updateForm = document.getElementById('updateCategoryForm')
    const categoryName = updateForm.querySelector('#groupeName');
    categoryId = this.dataset.id;

    if(categoryId){
        $.get("/api/categories/"+categoryId, function(data, status){
            if(status === 'success'){
                categoryName.value = data.groupeName;
            }
          });
    }
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
