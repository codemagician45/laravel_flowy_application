
// var data = '<?xml version="1.0" encoding="UTF-8"?><definitions xmlns="http://www.omg.org/spec/BPMN/20100524/MODEL" xmlns:bpmndi="http://www.omg.org/spec/BPMN/20100524/DI" xmlns:omgdc="http://www.omg.org/spec/DD/20100524/DC" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" targetNamespace="" xsi:schemaLocation="http://www.omg.org/spec/BPMN/20100524/MODEL http://www.omg.org/spec/BPMN/2.0/20100501/BPMN20.xsd"><process id="Process_1q5a2j8"><startEvent id="Event_1kfnb04" /></process><bpmndi:BPMNDiagram id="sid-74620812-92c4-44e5-949c-aa47393d3830"><bpmndi:BPMNPlane id="sid-cdcae759-2af7-4a6d-bd02-53f3352a731d" bpmnElement="Process_1q5a2j8"><bpmndi:BPMNShape id="Event_1kfnb04_di" bpmnElement="Event_1kfnb04"><omgdc:Bounds x="452" y="292" width="36" height="36" /></bpmndi:BPMNShape></bpmndi:BPMNPlane><bpmndi:BPMNLabelStyle id="sid-e0502d32-f8d1-41cf-9c4a-cbb49fecf581"><omgdc:Font name="Arial" size="11" isBold="false" isItalic="false" isUnderline="false" isStrikeThrough="false" /></bpmndi:BPMNLabelStyle><bpmndi:BPMNLabelStyle id="sid-84cb49fd-2f7c-44fb-8950-83c3fa153d3b"><omgdc:Font name="Arial" size="12" isBold="false" isItalic="false" isUnderline="false" isStrikeThrough="false" /></bpmndi:BPMNLabelStyle></bpmndi:BPMNDiagram></definitions>';

var bpmnViewer = new BpmnJS({
    container: '#canvas'
});
function openDiagram(bpmnXML) {

    // import diagram
    bpmnViewer.importXML(bpmnXML, function (err) {

        if (err) {
            return console.error('could not import BPMN 2.0 diagram', err);
        }

        // access viewer components
        var canvas = bpmnViewer.get('canvas');
        var overlays = bpmnViewer.get('overlays');


        // zoom to fit full viewport
        canvas.zoom('fit-viewport');

        // attach an overlay to a node
        // overlays.add('SCAN_OK', 'note', {
        //     position: {
        //         bottom: 0,
        //         right: 0
        //     },
        //     html: '<div class="diagram-note">Mixed up the labels?</div>'
        // });
        //
        // // add marker
        // canvas.addMarker('SCAN_OK', 'needs-discussion');
    });
}
$('.bjs-powered-by').remove();
// openDiagram(data);