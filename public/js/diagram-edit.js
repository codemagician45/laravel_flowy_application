
var data = '<?xml version="1.0" encoding="UTF-8"?><definitions xmlns="http://www.omg.org/spec/BPMN/20100524/MODEL" xmlns:bpmndi="http://www.omg.org/spec/BPMN/20100524/DI" xmlns:omgdc="http://www.omg.org/spec/DD/20100524/DC" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" targetNamespace="" xsi:schemaLocation="http://www.omg.org/spec/BPMN/20100524/MODEL http://www.omg.org/spec/BPMN/2.0/20100501/BPMN20.xsd"><process id="Process_1q5a2j8" /><bpmndi:BPMNDiagram id="sid-74620812-92c4-44e5-949c-aa47393d3830"><bpmndi:BPMNPlane id="sid-cdcae759-2af7-4a6d-bd02-53f3352a731d" bpmnElement="Process_1q5a2j8" /><bpmndi:BPMNLabelStyle id="sid-e0502d32-f8d1-41cf-9c4a-cbb49fecf581"><omgdc:Font name="Arial" size="11" isBold="false" isItalic="false" isUnderline="false" isStrikeThrough="false" /></bpmndi:BPMNLabelStyle><bpmndi:BPMNLabelStyle id="sid-84cb49fd-2f7c-44fb-8950-83c3fa153d3b"><omgdc:Font name="Arial" size="12" isBold="false" isItalic="false" isUnderline="false" isStrikeThrough="false" /></bpmndi:BPMNLabelStyle></bpmndi:BPMNDiagram></definitions>';

// modeler instance
var bpmnModeler = new BpmnJS({
    container: '#canvas',
    keyboard: {
        bindTo: window
    }
});

function exportDiagram() {
    bpmnModeler.saveXML({ format: true }, function (err, xml) {
        if (err) {
            return console.error('could not save BPMN 2.0 diagram', err);
        }
        console.log('DIAGRAM', xml);
        $('#flowchart_data').val(xml);
    });
}

function openDiagram(bpmnXML) {
    // import diagram
    bpmnModeler.importXML(bpmnXML, function (err) {
        if (err) {
            return console.error('could not import BPMN 2.0 diagram', err);
        }
        // access modeler components
        var canvas = bpmnModeler.get('canvas');
        var overlays = bpmnModeler.get('overlays');
        // zoom to fit full viewport
        canvas.zoom('fit-viewport');
        // attach an overlay to a node
        // overlays.add('SCAN_OK', 'note', {
        //   position: {
        //     bottom: 0,
        //     right: 0
        //   },
        //   html: '<div class="diagram-note">Mixed up the labels?</div>'
        // });

        // add marker
        // canvas.addMarker('SCAN_OK', 'needs-discussion');
    });
}
openDiagram(data);

$('.bjs-powered-by').remove();

var selectedBlock, selectedBlockId, blockData0, blockData = [], currentBlockInfo;

$(document).ready(function () {
    blockData0 = $('#block_data').val();
    if (blockData0) {
        blockData = JSON.parse(blockData0)
    }
})

$('body').on('click', '.djs-group', function () {
    selectedBlockId = this.children[0].getAttribute('data-element-id');
    currentBlockInfo = blockData.filter(data => {
        return data.id == selectedBlockId
    })
    $('.djs-group').removeClass('selectedblock');
    this.classList.add('selectedblock')
    document.getElementById("properties").classList.add("expanded");
    document.getElementById("propwrap").classList.add("itson");
    if (currentBlockInfo.length != 0) {
        // $('#name').val(currentBlockInfo[0].name);
        $('#description').val(currentBlockInfo[0].des);
        $('#assigned_user').val(currentBlockInfo[0].assignedUser);
        $('#url').val(currentBlockInfo[0].url);
        $('#process').val(currentBlockInfo[0].process);
        $('#role').val(currentBlockInfo[0].role);
    }
    else {
        // $('#name').val('');
        $('#description').val('');
        $('#assigned_user').val(0);
        $('#url').val('');
        $('#process').val(0);
        $('#role').val(0);
    }
    var trash = document.getElementsByClassName('bpmn-icon-trash')[0];
    if (trash)
        trash.addEventListener('click', function () {
            var thisId = this.parentNode.parentNode.parentNode.parentNode.getAttribute("data-container-id");
            blockData = blockData.filter(data => {
                return data.id != thisId
            })
            console.log(blockData)
        })

})

document.getElementById("close").addEventListener("click", function () {
    document.getElementById("properties").classList.remove("expanded");
    setTimeout(function () {
        document.getElementById("propwrap").classList.remove("itson");
    }, 300);
});

$('#flow_property_save').click(function () {
    selectedBlock = document.getElementsByClassName('selectedblock')[0];
    selectedBlockId = selectedBlock.children[0].getAttribute('data-element-id');
    // selectedBlock.children[0].children[0].children[1].children[0].textContent = $('#name').val();
    // selectedBlock.children[0].children[0].children[1].children[0].setAttribute('x', 50 - 3.34 * ($('#name').val().length))
    selectedBlock.children[0].classList.remove('selected')
    var found = false;
    for (let i = 0; i < blockData.length; i++) {
        if (blockData[i].id == selectedBlockId) {
            found = true;
            break;
        }
    }
    if (found) {
        blockData.forEach(data => {
            if (data.id == selectedBlockId) {
                data.name = '';
                data.assignedUser = $('#assigned_user').val();
                data.des = $('#description').val();
                data.url = $('#url').val();
                data.process = $('#process').val();
                data.role = $('#role').val();
            }
        })
    }
    else
        blockData.push(
            {
                id: selectedBlockId,
                // name: $('#name').val(),
                name: '',
                assignedUser: $('#assigned_user').val(),
                des: $('#description').val(),
                url: $('#url').val(),
                process: $('#process').val(),
                role: $('#role').val()
            }
        )
    console.log(blockData)
    document.getElementById("properties").classList.remove("expanded");
    setTimeout(function () {
        document.getElementById("propwrap").classList.remove("itson");
    }, 300);
    $('.djs-group').removeClass('selectedblock');
})

$('#url').change(function () {
    if ($(this).val()) {
        $('#process').val(0);
    }
})
$('#process').change(function () {
    if ($(this).val)
        $('#url').val('')
})


