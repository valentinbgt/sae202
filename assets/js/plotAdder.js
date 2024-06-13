const container = $("#addGardenForm .plotsList");
const button = $("#addPlotButton");

button.click(() => {
    container.append(`<div class="plot">
        <span>Ajouter 
        <input type="number" id="plotNumber" name="plotNumber[]" min="0" value="0"/> 
        parcelles</span> <span>de 
        <input type="number" id="plotSurface" name="plotSurface[]" min="0" value="0"/>
        m²</span>
    <div>`);
})