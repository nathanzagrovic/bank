import './bootstrap';
import AutoNumeric from "autonumeric";
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

function initNumeric() {
    const amount = document.getElementById('amount');
    if (amount) {
        window.anAmount = new AutoNumeric(amount, {
            currencySymbol: '£',
            decimalCharacter: '.',
            digitGroupSeparator: ',',
            decimalPlaces: 2,
            currencySymbolPlacement: 'p',
            minimumValue: '0',
            modifyValueOnWheel: false,
            unformatOnSubmit: true,
        });
    }
}
initNumeric();
window.initNumeric = initNumeric;
