# Celestial — Block Heading

Правила стилизации стандартного WordPress блока `core/heading`.

Heading — это один блок с разными HTML-уровнями `H1–H6`. Поэтому общие свойства блока и размер заголовка на конкретном уровне настраиваются отдельно.

## Где создавать настройки в `theme.json`

Общие типографические свойства заголовков задаются в `styles.elements.heading`. Цвет текста задаётся глобально в `styles.color.text` и использует токен `contrast`:

```json
{
  "styles": {
    "elements": {
      "heading": {
        "typography": {
          "fontFamily": "var:preset|font-family|ubuntu",
          "fontWeight": "var:custom|font-weight|bold",
          "lineHeight": "var:custom|line-height|tight"
        }
      }
    }
  }
}
```

Размеры по HTML-уровням задаются в `styles.elements`:

```json
{
  "styles": {
    "elements": {
      "h1": { "typography": { "fontSize": "var(--wp--preset--font-size--4-xl)" } },
      "h2": { "typography": { "fontSize": "var(--wp--preset--font-size--3-xl)" } },
      "h3": { "typography": { "fontSize": "var(--wp--preset--font-size--2-xl)" } },
      "h4": { "typography": { "fontSize": "var:preset|font-size|xl" } },
      "h5": { "typography": { "fontSize": "var:preset|font-size|lg", "lineHeight": "var:custom|line-height|snug" } },
      "h6": { "typography": { "fontSize": "var:preset|font-size|md", "lineHeight": "var:custom|line-height|snug" } }
    }
  }
}
```

## Default Mapping

| HTML level | Font Size | Font Weight | Line Height |
|---|---|---:|---:|
| `H1` | `4xl` | `700` | `tight` |
| `H2` | `3xl` | `700` | `tight` |
| `H3` | `2xl` | `700` | `tight` |
| `H4` | `xl` | `700` | `tight` |
| `H5` | `lg` | `700` | `snug` |
| `H6` | `md` | `700` | `snug` |

Это default mapping Celestial. Размер токена не является частью названия HTML-уровня: `H1` использует `4xl`, но `4xl` может быть применён и к другому элементу.

## Общие правила

1. Все heading-блоки используют семейство `ubuntu`, если конкретная композиция не требует другого решения.
2. Заголовки используют вес `bold` и не получают произвольные веса из редактора.
3. Крупные заголовки используют `tight`, а `H5–H6` — `snug`.
4. `H6` остаётся размером `md`; его иерархия создаётся весом, spacing, регистром и контекстом.
5. HTML-уровень выбирается по структуре документа, а не только по визуальному размеру.
6. Не следует использовать `H1` только как способ получить самый крупный текст.
7. В паттернах не задаются случайные размеры или inline-стили: используются зарегистрированные Font Size tokens и правила `theme.json`.

## Letter Spacing и H6

Для `H6` и других небольших uppercase labels может использоваться отдельный letter-spacing token:

```json
{
  "styles": {
    "elements": {
      "h6": {
        "typography": {
          "letterSpacing": "var:custom|letter-spacing|wide",
          "textTransform": "uppercase"
        }
      }
    }
  }
}
```

Это специальное применение, а не правило для всех заголовков.

## Editor Controls

Для `core/heading` в админке отключаются настройки, которые могут нарушить типографическую систему Celestial:

| Настройка | Правило | Зачем |
|---|---|---|
| Font | Скрыта через `typography.fontFamilies: []`. | Heading использует утверждённое семейство темы. |
| Font Size | Скрыта через `typography.fontSizes: []` и глобальное `customFontSize: false`. | Размер определяется уровнем `H1–H6` и mapping системы. |
| Text Color | Доступен только из палитры сайта. | По умолчанию наследует contrast из styles.color.text; отдельный дефолт блока не задаётся. |

Общие стили заголовков задаются через `styles.elements.heading`, а размеры уровней — через `styles.elements.h1–h6`. Для `core/heading` отдельно ограничиваются только `Font` и `Font Size`, потому что это block-specific controls. Остальные типографические ограничения задаются глобально в `settings.typography`. Общие ограничения Color также задаются в `settings.color`.

## Style Variations

Альтернативные визуальные варианты heading-блока добавляются только при реальной потребности. Например, `eyebrow` может быть отдельной variation для короткой надписи над заголовком.

Новая variation должна быть сначала зарегистрирована как block style variation, а затем стилизована через `theme.json`. Паттерны используют variation, а не набор локальных CSS-значений.

```text
Heading block
├── default → стандартная иерархия H1–H6
└── variation → отдельный подтверждённый визуальный сценарий
```

## Что не добавляется

- отдельные токены `heading-h1`, `heading-h2` и т. п.;
- отдельный шрифт для каждого уровня;
- произвольные размеры внутри паттернов;
- variation для каждого единичного визуального случая;
- forced `H1` ради внешнего вида без учёта структуры страницы.

## Текущая реализация

В `settings.blocks` файла `theme.json` для этого блока заданы пустые `typography.fontFamilies` и `typography.fontSizes`. При глобальных `defaultFontSizes: false` и `customFontSize: false` выбор семейства и размера скрыт. Базовые стили остаются в общих правилах темы и не дублируются на уровне блока.

Цвет текста по умолчанию наследуется; его выбор из десяти цветов сайта остаётся доступен. `color.text: false` не применяется. Ранее сохранённые пользовательские настройки не очищаются этими ограничениями UI.

Примеры дополнительных style variations описывают возможное расширение; сейчас они не зарегистрированы.
