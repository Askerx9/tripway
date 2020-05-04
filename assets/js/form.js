
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
            this.elements[i].addEventListener('input', this.change)
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