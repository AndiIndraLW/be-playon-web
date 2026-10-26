# Filament Dynamic Content & Database Schema Documentation

This document outlines the database schema, Eloquent model casting, and recommended Filament v3 form field components for managing dynamic content across the application.

---

## 1. Homepage Settings (Single Record / Site Configuration)

For managing global or single-record settings like the Homepage layout, you can use a custom Filament Manage Page with a single database record or a settings key-value store (such as `spatie/laravel-settings`).

### Database Table: `homepage_settings`

| Field Name | Database Type | Nullable | Description / Usage |
| :--- | :--- | :--- | :--- |
| `id` | `bigIncrements` | No | Primary Key |
| `hero_bg_video` | `string` | Yes | Path or URL for hero background video |
| `hero_title` | `string` | No | Main heading text for Hero section |
| `hero_subtitle` | `text` | Yes | Subtitle / description text for Hero section |
| `company_logos` | `json` | Yes | Array of uploaded company / client logo image paths |
| `section_1_text` | `text` | Yes | Primary body/headline text for Section 1 |
| `section_1_button_text` | `string` | Yes | Label for the Section 1 CTA button |
| `section_1_button_link` | `string` | Yes | URL / route target for the Section 1 CTA button |
| `created_at` / `updated_at` | `timestamp` | Yes | Laravel timestamps |

### Filament Form Component Mapping

| Section | Field | Filament Field Component | Component Configuration Details |
| :--- | :--- | :--- | :--- |
| **Hero Section** | Background Video | `FileUpload` / `TextInput` | `FileUpload::make('hero_bg_video')->acceptedFileTypes(['video/mp4', 'video/webm'])->directory('homepage')` or `TextInput::make('hero_bg_video')->url()` |
| **Hero Section** | Title Text | `TextInput` | `TextInput::make('hero_title')->required()->maxLength(255)` |
| **Hero Section** | Subtitle / Little Text | `Textarea` | `Textarea::make('hero_subtitle')->rows(2)->columnSpanFull()` |
| **Hero Section** | Company Logos | `FileUpload` | `FileUpload::make('company_logos')->multiple()->image()->reorderable()->directory('homepage/logos')` |
| **Section 1** | Text Content | `Textarea` / `RichEditor` | `Textarea::make('section_1_text')->rows(4)` or `RichEditor::make('section_1_text')` |
| **Section 1** | Button Text | `TextInput` | `TextInput::make('section_1_button_text')->maxLength(100)` |
| **Section 1** | Button Link | `TextInput` | `TextInput::make('section_1_button_link')->url()` |

---

## 2. Filament CRUD Resources

---

### A. Testimonials Resource

Manages client or user feedback displayed across the site.

#### Database Table: `testimonials`

| Column Name | Data Type | Nullable | Index / Extra | Description |
| :--- | :--- | :--- | :--- | :--- |
| `id` | `bigIncrements` | No | PK | Auto-increment primary key |
| `title` | `string` | Yes | - | Testimonial title or headline (e.g., "Great Service!") |
| `name` | `string` | No | - | Author / Client Name |
| `testimony` | `text` | No | - | Main testimonial body content |
| `created_at` | `timestamp` | Yes | - | Record creation timestamp |
| `updated_at` | `timestamp` | Yes | - | Record update timestamp |

#### Filament Form Field Specifications

| Field | Filament Component | Component Options & Recommendations |
| :--- | :--- | :--- |
| **Title** | `TextInput` | `TextInput::make('title')->maxLength(255)->placeholder('e.g. Outstanding Work')` |
| **Name** | `TextInput` | `TextInput::make('name')->required()->maxLength(255)->placeholder('e.g. John Doe')` |
| **Testimony** | `Textarea` | `Textarea::make('testimony')->required()->rows(5)->columnSpanFull()` |

#### Recommended Filament Table Columns
- `TextColumn::make('name')->searchable()->sortable()`
- `TextColumn::make('title')->searchable()`
- `TextColumn::make('created_at')->dateTime()->sortable()`

---

### B. Projects Resource

Manages portfolio showcase items, including featured image, gallery, tag, and rich descriptions.

#### Database Table: `projects`

| Column Name | Data Type | Nullable | Description |
| :--- | :--- | :--- | :--- |
| `id` | `bigIncrements` | No | Primary Key |
| `slug` | `string` | No | Unique slug for routing (Indexed) |
| `featured_image` | `string` | Yes | Path to featured image asset |
| `title` | `string` | No | Project name / title |
| `sub_title` | `string` | Yes | Brief subtitle / tagline |
| `logo` | `string` | Yes | Path to client/brand logo image |
| `is_highlight` | `boolean` | No | Display logo in homepage hero section if true |
| `tag` | `json` / `string` | Yes | Category tag(s) (e.g. `["Branding", "Web"]`) |
| `year` | `integer` / `string` | Yes | Year completed (e.g. `2024`) |
| `gallery` | `json` | Yes | Array of image paths (`["projects/g1.jpg", ...]`) |
| `description` | `text` / `longText` | Yes | Rich text HTML description |
| `created_at` / `updated_at` | `timestamp` | Yes | Timestamps |

#### Eloquent Model Casts (`Project.php`)
```php
protected $casts = [
    'gallery' => 'array',
    'tag' => 'array', // or string depending on multi-tag vs single tag
    'year' => 'integer',
    'is_highlight' => 'boolean',
];
```

#### Filament Form Field Specifications

| Field | Filament Component | Component Options & Recommendations |
| :--- | :--- | :--- |
| **Featured Image** | `FileUpload` | `FileUpload::make('featured_image')->image()->directory('projects/featured')->imageEditor()->columnSpanFull()` |
| **Title** | `TextInput` | `TextInput::make('title')->required()->maxLength(255)->live(onBlur: true)->afterStateUpdated(fn ($state, callable $set) => $set('slug', \Illuminate\Support\Str::slug($state)))` |
| **Sub-title** | `TextInput` | `TextInput::make('sub_title')->maxLength(255)` |
| **Upload Logo** | `FileUpload` | `FileUpload::make('logo')->image()->directory('projects/logos')->label('Upload Logo')` |
| **Highlight** | `Toggle` | `Toggle::make('is_highlight')->label('Highlight')->default(false)` |
| **Tag** | `TagsInput` / `TextInput` | `TagsInput::make('tag')->placeholder('Add tags...')` |
| **Year** | `TextInput` | `TextInput::make('year')->numeric()->length(4)->default(date('Y'))` |
| **Gallery** | `FileUpload` | `FileUpload::make('gallery')->multiple()->image()->reorderable()->directory('projects/gallery')->columnSpanFull()` |
| **Description** | `RichEditor` | `RichEditor::make('description')->toolbarButtons(['bold', 'italic', 'link', 'bulletList', 'orderedList', 'h2', 'h3'])->columnSpanFull()` |

---

### C. Services Resource

Manages service offerings provided by the business.

#### Database Table: `services`

| Column Name | Data Type | Nullable | Description |
| :--- | :--- | :--- | :--- |
| `id` | `bigIncrements` | No | Primary Key |
| `slug` | `string` | No | Unique slug for routing |
| `featured_image` | `string` | Yes | Path to service hero/thumbnail image |
| `title` | `string` | No | Service Title |
| `sub_title` | `string` | Yes | Short summary or tagline |
| `gallery` | `json` | Yes | Array of gallery image file paths |
| `description` | `text` / `longText` | Yes | Detailed rich text description |
| `created_at` / `updated_at` | `timestamp` | Yes | Timestamps |

#### Eloquent Model Casts (`Service.php`)
```php
protected $casts = [
    'gallery' => 'array',
];
```

#### Filament Form Field Specifications

| Field | Filament Component | Component Options & Recommendations |
| :--- | :--- | :--- |
| **Featured Image** | `FileUpload` | `FileUpload::make('featured_image')->image()->directory('services/featured')->columnSpanFull()` |
| **Title** | `TextInput` | `TextInput::make('title')->required()->maxLength(255)` |
| **Sub-title** | `TextInput` | `TextInput::make('sub_title')->maxLength(255)` |
| **Gallery** | `FileUpload` | `FileUpload::make('gallery')->multiple()->image()->reorderable()->directory('services/gallery')->columnSpanFull()` |
| **Description** | `RichEditor` | `RichEditor::make('description')->columnSpanFull()` |

---

### D. Articles Resource

Manages blog posts, news, or articles.

#### Database Table: `articles`

| Column Name | Data Type | Nullable | Description |
| :--- | :--- | :--- | :--- |
| `id` | `bigIncrements` | No | Primary Key |
| `slug` | `string` | No | Unique article slug |
| `featured_image` | `string` | Yes | Header / cover image path |
| `title` | `string` | No | Article title |
| `sub_title` | `string` | Yes | Subtitle / article excerpt |
| `gallery` | `json` | Yes | Media gallery array |
| `description` | `text` / `longText` | Yes | Main article body (rich text) |
| `published_at` | `timestamp` | Yes | Optional publication schedule date |
| `created_at` / `updated_at` | `timestamp` | Yes | Timestamps |

#### Eloquent Model Casts (`Article.php`)
```php
protected $casts = [
    'gallery' => 'array',
    'published_at' => 'datetime',
];
```

#### Filament Form Field Specifications

| Field | Filament Component | Component Options & Recommendations |
| :--- | :--- | :--- |
| **Featured Image** | `FileUpload` | `FileUpload::make('featured_image')->image()->directory('articles/featured')->columnSpanFull()` |
| **Title** | `TextInput` | `TextInput::make('title')->required()->maxLength(255)` |
| **Sub-title** | `TextInput` | `TextInput::make('sub_title')->maxLength(255)` |
| **Gallery** | `FileUpload` | `FileUpload::make('gallery')->multiple()->image()->reorderable()->directory('articles/gallery')->columnSpanFull()` |
| **Description** | `RichEditor` | `RichEditor::make('description')->columnSpanFull()` |

---

## 3. Summary Matrix of Required Resources & Fields

| Resource | Field Name | Database Column Type | Recommended Filament Component | Key Attributes / Features |
| :--- | :--- | :--- | :--- | :--- |
| **Homepage** | `hero_bg_video` | `string` | `FileUpload` / `TextInput` | Accepted types: MP4/WebM or URL input |
| **Homepage** | `hero_title` | `string` | `TextInput` | Required text field |
| **Homepage** | `section_1_text` | `text` | `Textarea` / `RichEditor` | Multi-line text field |
| **Homepage** | `section_1_button_text` | `string` | `TextInput` | CTA button label |
| **Homepage** | `section_1_button_link` | `string` | `TextInput` | URL validation |
| **Testimonials**| `title` | `string` | `TextInput` | Headline / subject |
| **Testimonials**| `name` | `string` | `TextInput` | Required author name |
| **Testimonials**| `testimony` | `text` | `Textarea` | Required full text |
| **Projects** | `featured_image` | `string` | `FileUpload` | Image format, single upload |
| **Projects** | `title` | `string` | `TextInput` | Required |
| **Projects** | `sub_title` | `string` | `TextInput` | Optional tagline |
| **Projects** | `tag` | `json` / `string` | `TagsInput` | Multi-tag chip selection |
| **Projects** | `year` | `integer` | `TextInput` | Numeric input, 4-digit validation |
| **Projects** | `gallery` | `json` | `FileUpload` | `multiple()`, `reorderable()` |
| **Projects** | `description` | `text` | `RichEditor` | WYSIWYG HTML Editor |
| **Services** | `featured_image` | `string` | `FileUpload` | Image file upload |
| **Services** | `title` | `string` | `TextInput` | Service name |
| **Services** | `sub_title` | `string` | `TextInput` | Short subtitle |
| **Services** | `gallery` | `json` | `FileUpload` | `multiple()`, `reorderable()` |
| **Services** | `description` | `text` | `RichEditor` | WYSIWYG HTML Editor |
| **Articles** | `featured_image` | `string` | `FileUpload` | Cover image upload |
| **Articles** | `title` | `string` | `TextInput` | Article title |
| **Articles** | `sub_title` | `string` | `TextInput` | Subtitle / Excerpt |
| **Articles** | `gallery` | `json` | `FileUpload` | `multiple()`, `reorderable()` |
| **Articles** | `description` | `text` | `RichEditor` | WYSIWYG HTML Editor |

---

## 4. Laravel Migration Example Snippet

```php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Projects Table
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('sub_title')->nullable();
            $table->string('featured_image')->nullable();
            $table->json('tag')->nullable();
            $table->integer('year')->nullable();
            $table->json('gallery')->nullable();
            $table->longText('description')->nullable();
            $table->timestamps();
        });

        // Services Table
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('sub_title')->nullable();
            $table->string('featured_image')->nullable();
            $table->json('gallery')->nullable();
            $table->longText('description')->nullable();
            $table->timestamps();
        });

        // Articles Table
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('sub_title')->nullable();
            $table->string('featured_image')->nullable();
            $table->json('gallery')->nullable();
            $table->longText('description')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });

        // Testimonials Table
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('name');
            $table->text('testimony');
            $table->timestamps();
        });

        // Homepage Settings Table
        Schema::create('homepage_settings', function (Blueprint $table) {
            $table->id();
            $table->string('hero_bg_video')->nullable();
            $table->string('hero_title')->nullable();
            $table->text('section_1_text')->nullable();
            $table->string('section_1_button_text')->nullable();
            $table->string('section_1_button_link')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('homepage_settings');
        Schema::dropIfExists('testimonials');
        Schema::dropIfExists('articles');
        Schema::dropIfExists('services');
        Schema::dropIfExists('projects');
    }
};
```
