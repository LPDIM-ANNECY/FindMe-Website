export default class ChooseLanguage extends HTMLElement {

    constructor()
    {
        super()
        this.languageName = this.getAttribute('name')
        this.languageCode = this.getAttribute('code')
        this.className += 'position-relative cursor-pointer'
        this.setAttribute('onClick', `location='${this.getAttribute('route')}'`)
        this.innerHTML = `
            <span class="flag flag-${this.languageCode}"></span>
            <p class="mt-4"><b>${this.languageName}</b></p>
            <div class="go">
                <i class="las la-3x la-chevron-right"></i>
            </div>
        `
    }

}
