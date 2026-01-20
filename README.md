# DGM CPT Theme

A custom WordPress theme foundation built around **structured content**, **Custom Post Types**, and **ACF-driven templates**, designed for musician and artist websites that require flexible event management.

This repository currently focuses on a fully custom **Events (Shows) archive system** with featured shows, date-based filtering, and extensible layout logic.

---

## Overview

This theme demonstrates:

- Custom Post Type–driven content architecture
- ACF field–based rendering (no page builders)
- Clean PHP templates using `WP_Query`
- Production-safe Git workflow (feature branches + PRs)
- Reusable patterns suitable for agency and freelance projects

---

## Events (Shows) System

### Custom Post Type
- **CPT:** `event`
- Designed for live shows, performances, and appearances

### Core Fields (ACF)
| Field Name        | Type        | Description |
|------------------|-------------|-------------|
| `event_date`     | Date Picker | Show date (stored as `Ymd`) |
| `is_featured`    | True/False  | Marks show as featured |
| Featured Image   | Image       | Flyer / show artwork |

### ACF Options
| Field Name | Description |
|-----------|-------------|
| `shows_hero_image` | Background image for the Shows archive hero |

---

## Archive Template (`archive-event.php`)

The Events archive is fully custom and replaces default WordPress archive behavior.

### Sections

#### 1. Hero
- Full-width hero section
- Background image pulled from **ACF Options**
- Static title and intro copy (easily editable)

#### 2. Featured Shows
- Displays up to **3 upcoming featured events**
- Date-based filtering (today → +365 days)
- Sorted chronologically
- Displays flyer, title, date, and details link

#### 3. Upcoming Shows List
- Lists **all upcoming events for the next 365 days**
- Chronologically ordered
- Designed to support scrollable or paginated layouts
- Featured events are allowed to appear here once (no duplication within the list)

#### 4. Booking CTA
- Call-to-action section
- Triggers modal-based booking form (modal handled separately)

---

## Query Strategy

Shared date range logic is used across all queries for consistency:

```php
$today  = date('Ymd');
$future = date('Ymd', strtotime('+365 days'));
