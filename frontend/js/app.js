
var basePath = "http://localhost/xspeed_task";


$(document).ready(function ($) {
    


    loadOptions(".options, #options");

    $("#buyer_email").blur(function () {
        let isvalid = ValidateEmail(this.value);
        if (!isvalid) {
            $("#submit").attr('disabled', true);
            $(this).css("color", 'red');
        }
        $("#submit").attr('disabled', false);

    });
    $("#phone").blur(function () {
        let isvalid = mobileNumberValidation(this.value);
        if (!isvalid) {
            $("#submit").attr('disabled', true);
            $(this).css("color", 'red');
        }
        $("#submit").attr('disabled', false);
    });

    $("#amount").blur(function () {
        let isvalid = numberOnlyCheck(this.value);
        if (!isvalid) {
            $("#submit").attr('disabled', true);
            $(this).css("color", 'red');
        }
        $("#submit").attr('disabled', false);
    });
    $('#note').on("keypress", function (evt) {
        // console.log(evt);
        // Get value of textbox and split into array where there is one or more continous spaces
        var words = this.value.split(/\s+/);
        var numWords = words.length;    // Get # of words in array
        var maxWords = 20;

        // If we are at the limit and the key pressed wasn't BACKSPACE or DELETE,
        // don't allow any more input
        if (numWords > maxWords) {
            alertMsg("Max Word Length 20", 'error');
            evt.preventDefault();
        }
    });


});



function saveData() {
    var url = basePath+"/backend/process/post.php";

    event.preventDefault();
    $.ajax({
        url: url,
        method: "POST",
        type: 'json',
        data:
            $("form").serialize(),

        success: function (result) {
            if (result) {
                let jsonData = JSON.parse(result);
                $(`input, textarea`).css("border-bottom", '1px solid black');

                var len = 0;
                for (error in jsonData.error) {
                    $(`#${error}`).css("border-bottom", '1px solid red');
                    len++;
                }
                if (len == 0 && jsonData.saved) {
                    $("#form")[0].reset();
                    alertMsg("Save Success", 'success');
                    loadGrid();
                    modal.style.display = "none";
                } else if (len > 0) {
                    alertMsg("Save failed", 'error');
                }

            }

        },
        error: function () {
            alertMsg("Save Failed", 'error');
        }
    });
}


function loadOptions(element, id = '') {

    $.ajax({
        url: basePath+'/backend/process/grid.php',
        method: "POST",
        type: 'json',
        data: {
            option: "user",
        },

        success: function (result) {
            if (result) {
                let jsonData = JSON.parse(result)
                let data = ``;
                let dataLength = jsonData.length;
                let elem = $(element);
                for (let i = 0; i < dataLength; i++) {
                    data += `<option value="${jsonData[i]['id']}" ${id == jsonData[i]['id'] ? 'selected' : ''}>${jsonData[i]['username']}</option>
                   `;
                }
                elem.html(data);

            }

        },
        error: function () {
            alertMsg("Load Failed", 'error');
        }
    });
}



function loadGrid(id = '') {

    $.ajax({
        url: basePath+'/backend/process/grid.php',
        method: "POST",
        type: 'json',
        data: {
            grid: "fetch",
            id: id,
            field: 'entry_by'
        },

        success: function(result) {
            if (result) {
                let jsonData = JSON.parse(result)
                let data = ``;
                let dataLength = jsonData.length;
                let gridData = document.getElementById("grid-data");
                for (let i = 0; i < dataLength; i++) {
                    data += `
                   
                    
                <tr>
                <td>${jsonData[i]['stid']}</td>
                    <td>${jsonData[i]['receipt_id']}</td>
                    <td>${jsonData[i]['items']}</td>
                    <td>${jsonData[i]['phone']}</td>
                    <td>${jsonData[i]['amount']}</td>
                    <td>${jsonData[i]['buyer']}</td>
                    <td>${jsonData[i]['buyer_email']}</td>
                    <td>${jsonData[i]['city']}</td>
                    <td>${jsonData[i]['username'] ?? ''}</td>
                    <td>${jsonData[i]['entry_at'] ?? ''}</td>
                    <td><button data-id="${jsonData[i]['stid']}" onclick="editData(${jsonData[i]['stid']})" class="edit-data button-blue button">Edit</button></td>
                    <td><button data-id="${jsonData[i]['stid']}" onclick="deleteData(${jsonData[i]['stid']})" class="delete-data  button-red button">Delete</button></td>
                </tr>`;
                }
                gridData.innerHTML = data;

            }

        },
        error: function() {
            alertMsg("Load Failed", 'error');
        }
    });
}

function deleteData(id) {
    if (!id) return false;
    if (!confirm('Do Want to Delete ?')) return false;
    $.ajax({
        url: basePath+'/backend/process/grid.php',
        method: "POST",
        type: 'json',
        data: {
            grid: "delete",
            id: id,
        },

        success: function(result) {
            if (result) {
                loadGrid()
                alertMsg("Delete Success", 'success');
            } else {
                alertMsg("Delete failed", 'error');
            }

        },
        error: function() {
            alertMsg("Save Failed", 'error');
        }
    });
}



function SearchGrid() {

    event.preventDefault();
    if( !$("#search_value").val().trim()){
        $("#search_value").focus();
        alertMsg('Please Give any value','error');
         return false;
    }
    $.ajax({
        url: basePath+'/backend/process/grid.php',
        method: "POST",
        type: 'json',
        data: {
            grid: "search",
            search_value: $("#search_value").val(),
            search_field: $("#search_field").val()
        },

        success: function (result) {
            if (result) {
                let jsonData = JSON.parse(result)
                let data = `<tr><td width="100%">Noting Matched</td></tr>`;
                let dataLength = jsonData.length;
                let gridData = document.getElementById("grid-data");
                for (let i = 0; i < dataLength; i++) {

                    data = `
                
                    <tr>
                    <td>${jsonData[i]['stid']}</td>
                    <td>${jsonData[i]['receipt_id']}</td>
                    <td>${jsonData[i]['items']}</td>
                    <td>${jsonData[i]['phone']}</td>
                    <td>${jsonData[i]['amount']}</td>
                    <td>${jsonData[i]['buyer']}</td>
                    <td>${jsonData[i]['buyer_email']}</td>
                    <td>${jsonData[i]['city']}</td>
                    <td>${jsonData[i]['username'] ?? ''}</td>
                    <td>${jsonData[i]['entry_at'] ?? ''}</td>
                    <td><button data-id="${jsonData[i]['stid']}" onclick="editData(${jsonData[i]['stid']})" class="edit-data button-blue button">Edit</button></td>
                    <td><button data-id="${jsonData[i]['stid']}" onclick="deleteData(${jsonData[i]['stid']})" class="delete-data  button-red button">Delete</button></td>
                </tr>`;
                }
                gridData.innerHTML = data;

            }

        },
        error: function () {
            alertMsg("Load Failed", 'error');
        }
    });
}

var modal = document.getElementById("myModal");

        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal 




        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }


        function editData(id) {
            $.ajax({
                url: basePath+'/backend/process/grid.php',
                method: "POST",
                type: 'json',
                data: {
                    grid: "editsingle",
                    id: id,
                    field: 'id'
                },

                success: function(result) {
                    if (result) {
                        let jsonData = JSON.parse(result)
                        console.log(jsonData)
                        let data = ``;
                        let formData = $("#form-content");

                        data += `
                        
                        <section>
        <div>
            <form action="" id="form" method="post">

                <div>
                    <label for="buyer_email">Buyer Email <span class="mandatory">*</span> </label>
                    <input type="hidden" id="id" value="${jsonData[0]['stid']}" required name="id" />
                    <input type="email" id="buyer_email" value="${jsonData[0]['buyer_email']}" required name="buyer_email" />
                </div>
                <div>
                    <label for="phone">Phone <span class="mandatory">*</span> </label>
                    <input type="text" id="phone" required name="phone" value="${jsonData[0]['phone']}" />
                </div>
                <div>
                    <label for="amount">Amount <span class="mandatory">*</span></label>
                    <input type="text" id="amount" required name="amount" value="${jsonData[0]['amount']}" />
                </div>
                <div>
                    <label for="buyer">Buyer <span class="mandatory">*</span></label>
                    <input type="text" id="buyer" required name="buyer" value="${jsonData[0]['buyer']}" maxlength="20" />
                </div>
                <div>
                    <label for="items">Items <span class="mandatory">*</span></label>
                    <input type="text" id="items" required name="items" value="${jsonData[0]['items']}" />
                </div>
                <div>
                    <label for="receipt_id">Receipt ID <span class="mandatory">*</span></label>
                    <input type="text" id="receipt_id" required name="receipt_id"  value="${jsonData[0]['receipt_id']}" />
                </div>
                <div>
                    <label for="city">City <span class="mandatory">*</span></label>
                    <input type="text" id="city" required name="city" value="${jsonData[0]['city']}" />
                </div>
                <div>
                    <label for="city">Entry By <span class="mandatory">*</span></label>
                    <select type="text" id="entry_by" class="options" name="entry_by"><select/>
                </div>
                <div>

                    <label for="note">Note <span class="mandatory">*</span></label>
                    <textarea name="note" id="note" required cols="20" rows="5">${jsonData[0]['note']}</textarea>

                </div>

                <div>
                    <input type="hidden" name="submit" value="update">
                    <button type="submit" id="submit" class="button" value="save" onclick=saveData()> Save</button>
                </div>
            </form>
        </div>
    </section>

                        `;
                        formData.html(data);
                        loadOptions(".options", jsonData[0]['entry_by']);


                        modal.style.display = "block";
                    }

                },
                error: function() {
                    alertMsg("Load Failed", 'error');
                }
            });

        }

function alertMsg(message, msgType) {
    var type = msgType == 'error' ? 'red' : 'green';
    $("#message-alert").text(message)
        .css('color', type).fadeIn(2000).fadeOut(3000);
}

function ValidateEmail(mail) {

    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail)) {
        return true;
    }
    return false;

}

function mobileNumberValidation(val) {
    var regx = /^(?:\+?88|0088)?01[13-9]\d{8}$/;
    if (regx.test(val)) {
        return true;
    }
    return false;
}


function numberOnlyCheck(val) {
    if ((/^[0-9]+$/).test(val.trim())) {
        return true
    } else {
        return false
    }
}

function textSpaceValidation(val) {

    var reg = /^[a-zA-Z\s]*$/;
    if (!reg.test(val)) { //
        return false;
    }
    return true;

}





function wordValidate(val, wordLength) {
    // Get value of textbox and split into array where there is one or more continous spaces
    var words = val.split(/\s+/);
    var numWords = words.length;    // Get # of words in array
    var maxWords = wordLength;

    // If we are at the limit and the key pressed wasn't BACKSPACE or DELETE,
    // don't allow any more input
    if (numWords > maxWords) {
        //   console.log(words);
        evt.preventDefault(); // Cancel event
        return false;
    }
    return true;
}