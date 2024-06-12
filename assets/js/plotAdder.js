const form = $("#addGardenForm");
const button = $("#addPlotButton");
const submit = $("#submitGardenButton");

button.click(() => {
    form.append(`<div>
        Ajouter 
        <input type="number" id="plotNumber" name="plotNumber[]" min="0" value="0"/> 
        parcelles de 
        <input type="number" id="plotSurface" name="plotSurface[]" min="0" value="0"/>
        m²
        <br>
    <div>`);

    submit.appendTo(form);
})