# SMPN 4 Samarinda - Modern Dark Blue Theme Documentation

## Theme Customization Guide

This theme provides extensive customization options through CSS variables and documented sections in the code.

### 🎨 Color Customization

The theme uses CSS variables defined in `assets/css/custom.css`. To customize colors, modify these variables:

```css
:root {
  /* === CUSTOMIZABLE BRAND COLORS === */
  --primary-blue: #0D47A1;         /* Main brand color */
  --accent-blue: #1976D2;          /* Secondary brand color */
  --primary-dark: #0A3A8A;         /* Darker shade for depth */
  --primary-light: #E3F2FD;        /* Light shade for backgrounds */
  
  /* === STATUS AND ACCENT COLORS === */
  --status-success: #4CAF50;       /* Green for success states */
  --status-warning: #FF9800;       /* Orange/Yellow for warnings */
  --status-error: #F44336;         /* Red for errors */
  --status-info: #2196F3;          /* Blue for info */
}
```

### 📝 Customizable Sections

Look for `<!-- CUSTOMIZABLE SECTION: -->` comments in the following files:

#### 1. Header Branding (`components/header.php`)
- School logo and name display
- Contact information layout
- Header background and styling

#### 2. Navigation Menu (`components/nav.php`)
- Menu structure and styling
- Dropdown behavior
- Mobile menu appearance

#### 3. Hero Section (`home.php`)
- School information display
- Social media links
- Contact details presentation

#### 4. Footer Branding (`components/footer.php`)
- Copyright information
- Theme credits
- Additional branding elements

### 🎯 Interactive Effects

The theme includes modern JavaScript effects in `assets/js/modern-effects.js`:

- **Ripple Effect**: Automatically applied to buttons
- **Fade-in Animations**: Triggered on scroll for cards
- **Floating Action Button**: Scroll-to-top functionality
- **Card Hover Effects**: 3D tilt and shadow enhancements

### 📱 Responsive Design

The theme is fully responsive with breakpoints at:
- Mobile: < 1024px
- Desktop: ≥ 1024px

Mobile-specific styles are automatically applied for navigation and layout.

### ♿ Accessibility Features

- **Focus Indicators**: Clear outline for keyboard navigation
- **Color Contrast**: WCAG compliant color combinations
- **Reduced Motion**: Respects user's motion preferences
- **Screen Reader**: Proper ARIA labels and semantic HTML

### 🔧 Advanced Customization

For advanced customization, you can:

1. **Modify Material Design Properties**:
```css
--card-radius: 16px;             /* Corner radius */
--card-shadow: ...;              /* Shadow effects */
--transition-standard: 0.25s;    /* Animation timing */
```

2. **Adjust Typography**:
```css
--font-main: 'Inter', sans-serif;
--font-heading: 'Roboto', sans-serif;
```

3. **Customize Spacing**:
```css
--spacing-xs: 0.5rem;
--spacing-sm: 1rem;
--spacing-md: 1.5rem;
--spacing-lg: 2rem;
--spacing-xl: 3rem;
```

### 🚀 Performance Tips

- The theme uses CSS custom properties for consistent theming
- JavaScript effects are optimized with debounced scroll events
- Images should be optimized for web delivery
- The floating action button only appears after scrolling 300px

### 📞 Support

For additional customization or support, refer to the original Barka theme documentation or contact the theme developers.

---

**Theme Version**: Modern Dark Blue Theme v1.0  
**Compatible with**: Barka Theme v1.5.1+  
**Last Updated**: July 2025