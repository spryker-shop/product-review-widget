import Component from 'ShopUi/models/component';

export default class RatingSelector extends Component {
    input: HTMLInputElement
    steps: HTMLElement[]

    readyCallback() {
        this.input = <HTMLInputElement>this.querySelector(`.${this.componentSelector}__input`);
        this.steps = <HTMLElement[]>Array.from(this.getElementsByClassName(`${this.componentSelector}__step`));

        if (!this.readOnly) {
            this.checkInput(this.value);
            this.mapEvents();
        }
    }

    mapEvents() {
        this.steps.forEach((step: HTMLElement) => step.addEventListener('click', (event: Event) => this.onStepClick(event)));
    }

    onStepClick(event: Event) {
        event.preventDefault();

        const step = <HTMLElement>event.currentTarget;
        const newValue = parseFloat(step.getAttribute('data-step-value'));

        this.checkInput(newValue);
        this.updateRating(newValue);
    }

    checkInput(value: number): void {
        if (!this.disableIfEmptyValue) {
            return;
        }

        if (!value) {
            this.input.setAttribute('disabled', 'disabled');
            return;
        }

        this.input.removeAttribute('disabled');
    }

    updateRating(value: number): void {
        this.input.setAttribute('value', `${value}`);

        this.steps.forEach((step: HTMLElement) => {
            const stepValue = parseFloat(step.getAttribute('data-step-value'));

            if (value >= stepValue) {
                step.classList.add(`${this.componentName}__step--active`);
                return;
            }

            step.classList.remove(`${this.componentName}__step--active`);
        });
    }

    get value(): number {
        return parseFloat(this.input.value);
    }

    get readOnly(): boolean {
        return this.hasAttribute('readonly');
    }

    get disableIfEmptyValue(): boolean {
        return this.hasAttribute('disable-if-empty-value');
    }
}
