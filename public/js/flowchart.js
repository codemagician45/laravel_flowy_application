document.addEventListener("DOMContentLoaded", function () {
    var status = $('#status').val();
    var rightcard = false;
    var tempblock;
    var tempblock2;

    flowy(document.getElementById("canvas"), drag, release, snapping);

    var flowyDataJson = $('#flow_import').val();
    if (flowyDataJson) {
        var flowyData = JSON.parse(flowyDataJson);
        flowy.import(flowyData)
    }

    function addEventListenerMulti(type, listener, capture, selector) {
        var nodes = document.querySelectorAll(selector);
        for (var i = 0; i < nodes.length; i++) {
            nodes[i].addEventListener(type, listener, capture);
        }
    }
    function snapping(drag, first) {
        if (status == 'show')
            return false;
        return true;
    }

    function drag(block) {
        block.classList.add("blockdisabled");
        tempblock2 = block;
    }
    function release() {
        if (tempblock2) {
            tempblock2.classList.remove("blockdisabled");
        }
    }

    if (status != 'show') {
        document.getElementById("close").addEventListener("click", function () {
            if (rightcard) {
                rightcard = false;
                document.getElementById("properties").classList.remove("expanded");
                setTimeout(function () {
                    document.getElementById("propwrap").classList.remove("itson");
                }, 300);
                tempblock.classList.remove("selectedblock");
            }
        });
        document.getElementById("clearblock").addEventListener("click", function () {
            flowy.deleteBlocks();
        });
    }

    var aclick = false;
    var noinfo = false;
    var title, des, user, url, process, role;
    var beginTouch = function (event) {
        aclick = true;
        noinfo = false;
        if (event.target.closest(".create-flowy")) {
            noinfo = true;
        }
    }
    var checkTouch = function (event) {
        aclick = false;
    }
    var doneTouch = function (event) {
        if (event.type === "mouseup" && aclick && !noinfo) {
            if (!rightcard && event.target.closest(".block") && !event.target.closest(".block").classList.contains("dragging")) {
                tempblock = event.target.closest(".block");
                title = tempblock.children[1].children[0].children[0].textContent;
                des = tempblock.children[1].children[0].children[1].textContent;
                user = tempblock.children[1].children[0].children[2].value;
                url = tempblock.children[1].children[0].children[3].value;
                process = tempblock.children[1].children[0].children[4].value;
                role = tempblock.children[1].children[0].children[5].value;
                $('#name').val(title);
                $('#description').val(des);
                $('#assigned_user').val(user);
                $('#url').val(url);
                $('#process').val(process);
                $('#role').val(role);
                rightcard = true;
                if (status != 'show') {
                    document.getElementById("properties").classList.add("expanded");
                    document.getElementById("propwrap").classList.add("itson");
                    tempblock.classList.add("selectedblock");
                }
            }
        }
    }

    addEventListener("mousedown", beginTouch, false);
    addEventListener("mousemove", checkTouch, false);
    addEventListener("mouseup", doneTouch, false);
    addEventListenerMulti("touchstart", beginTouch, false, ".block");

    var selectedBlock;
    $('#flow_property_save').click(function () {
        var name = $('#name').val();
        var description = $('#description').val();
        var assignedUser = $('#assigned_user').val();
        var editUrl = $('#url').val();
        var editProcess = $('#process').val();
        var editRole = $('#role').val();
        selectedBlock = document.getElementsByClassName('selectedblock')[0];
        selectedBlock.children[1].children[0].children[0].textContent = name;
        selectedBlock.children[1].children[0].children[1].textContent = description;
        selectedBlock.children[1].children[0].children[2].value = assignedUser;
        if (editUrl) {
            selectedBlock.children[1].children[0].children[3].value = editUrl;
            selectedBlock.children[1].children[0].children[4].value = 0;
        }
        else {
            selectedBlock.children[1].children[0].children[3].value = '';
            selectedBlock.children[1].children[0].children[4].value = editProcess;
        }
        selectedBlock.children[1].children[0].children[5].value = editRole;
        if (rightcard) {
            rightcard = false;
            document.getElementById("properties").classList.remove("expanded");
            setTimeout(function () {
                document.getElementById("propwrap").classList.remove("itson");
            }, 300);
            tempblock.classList.remove("selectedblock");
        }

    });
    // $('#flow_property_delete').click(function () {
    //     selectedBlock = document.getElementsByClassName('selectedblock')[0];
    //     selectedBlock.parentNode.removeChild(selectedBlock)
    // });

    $('#url').change(function () {
        if ($(this).val()) {
            $('#process').val(0);
        }
    })
    $('#process').change(function () {
        if ($(this).val)
            $('#url').val('')
    })


});


