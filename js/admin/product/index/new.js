
function addAttributeField() {

    const select = document.getElementById('attribute-select');
    const container = document.getElementById('attribute-container');
    const selectedOption = select.options[select.selectedIndex];

    if (selectedOption.value) {
        const attributeId = selectedOption.value;
        const attributeName = selectedOption.text;
        const attributeType = selectedOption.getAttribute('data-type');

        const fieldWrapper = document.createElement('div');
        fieldWrapper.classList.add('form-group');
        fieldWrapper.innerHTML = `
    <label>${attributeName}</label>
    <input type="hidden" name="catalog_product_attribute[${attributeId}][attribute_id]" value="${attributeId}">
    <input type="${getInputType(attributeType)}" name="catalog_product_attribute[${attributeId}][value]">
`;

        container.appendChild(fieldWrapper);
    }
}

function getInputType(attributeType) {
    switch (attributeType) {
        case 'number':
            return 'number';
        case 'boolean':
            return 'checkbox';
        case 'date':
            return 'date';
        default:
            return 'text';
    }
}
