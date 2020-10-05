# &lt;fb-editor&gt;

![fb-editor](/assets/awema-pl/wiki/docs/fb-editor.png)

## Конфигурация по-умолчанию

Глобально опции для текстового редактора можно добавить в поле `AWEMA_CONFIG.formBuilder.fbEditor`.

[Список опций](https://www.tiny.cloud/docs/configure/)

### Пример:

```javascript
const AWEMA_CONFIG = {
    formBuilder: {
        fbEditor: {
            content_css: ['/path-to.css'] // добавляет <link rel="stylesheet" href="/path-to.css"/> в iframe редактора
        }
    }
}
```