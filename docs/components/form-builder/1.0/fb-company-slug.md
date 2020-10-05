# Компонент &lt;fb-company-slug&gt;

Компонент для преобразования текста в url (использует библиотеку [urlify](https://github.com/Gottox/node-urlify))

Может находиться только внутри &lt;form-builder&gt; и требует наличие &lt;fb-input&gt; из которого преобразуется субдомен.

![fb-company-slug](/assets/awema-pl/wiki/docs/fb-company-slug.gif)


## <a name="fbcs-example"></a> Пример использования компонента

```html
<form-builder url="/api-url">
    <fb-input name="company" label="Enter company name"></fb-input>
    <fb-company-slug name="slug" input="company"></fb-company-slug>
</form-builder>
```
@vue
<form-builder url="/api-url">
    <fb-input name="company" label="Enter company name"></fb-input>
    <fb-company-slug name="slug" input="company"></fb-company-slug>
</form-builder>
@endvue


## Свойства компонента

| Название            | Тип                | По-умолчанию        | Описание                                          |
|---------------------|:------------------:|:-------------------:|---------------------------------------------------|
| **name(*)**         | `String`           | `undefined`         | Идентификатор поля в объекте данных               |
| **id**              | `Number`           | `undefined`         | Порядковый номер внутри &lt;fb-multi-block&gt;    |
| **cell**            | `String`, `Number` | `undefined`         | Количество колонок в ряду. Может быть 2 или 3     |
| **label**           | `String`           | `''`                | Текст в элементе &lt;label&gt;                    |
| **domain**          | `String`           | `'awema.pl'`      | Основной домен                                    |
| **input(*)**        | `String`           | `undefined`         | Идентификатор поля, из которого строится субдомен |
| **max-length**      | `Number`           | `32`                | Mаксимальная длина субдомена                      |
| **enter-skip**      | `Boolean`          | `false`             | Пропускать поле при переключении по <kbd>enter</kbd> |
| **focus**           | `Boolean`          | `false`             | Установить фокус в это поле при загрузке страницы |


## Особенности компонента

### Конфигурация компонента

Для переопределения настроек по-умолчанию необходимо переопределить их в `AWEMA_CONFIG`

```javascript
// приведены настройки по-умолчанию
const AWEMA_CONFIG = {
    companySlug: {
        domain: 'awema.pl',
        length: 32,
        // настройки библиотеки urlify, подробнее тут https://github.com/Gottox/node-urlify#browser-1
        ulrifyOptions: {
            spaces: '-',
            toLower: true,
            trim: true,
            addEToUmlauts: true,
            nonPrintable: '',
            failureOutput: ''
        }
    }
}
```