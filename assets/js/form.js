
export default class FormInput
{
    /**
     *
     * @param selector
     */
    constructor(selector)
    {
        this.elements = document.querySelectorAll(selector);

        for (let i = 0; i < this.elements.length; i++)
        {
            const el = this.elements[i];

            if(el.value.length > 0) {
                el.parentElement.querySelector('label').classList.add('label--change')
            }
            el.addEventListener('change', this.change)
            el.addEventListener('input', this.change)
        }
    }



    change (e)
    {
        const label = e.target.parentElement.querySelector('label');
        const value = e.target.value;

        if(value.length === 0 && label.classList.contains('label--change')) {
            label.classList.remove('label--change')
        } else {
            label.classList.add('label--change')
        }
    }

}

new FormInput('.form__input input');