const fs = require('fs');
const path = require('path');

const dir = 'resources/views';
const files = [
    'resources/views/front-office/admission/edit.blade.php',
    'resources/views/front-office/admission/create.blade.php',
    'resources/views/front-office/polyclinic/index.blade.php',
    'resources/views/front-office/polyclinic/edit.blade.php',
    'resources/views/front-office/polyclinic/create.blade.php',
    'resources/views/front-office/patient/edit.blade.php',
    'resources/views/front-office/patient/create.blade.php',
    'resources/views/front-office/insurance/edit.blade.php',
    'resources/views/front-office/insurance/create.blade.php',
    'resources/views/back-office/staffing/index.blade.php',
    'resources/views/back-office/staffing/edit.blade.php',
    'resources/views/back-office/staffing/create.blade.php'
];

files.forEach(file => {
    if (!fs.existsSync(file)) return;
    let content = fs.readFileSync(file, 'utf8');

    // This regex looks for a label, followed by optional whitespace or a div/span wrapper,
    // and then an input, select, or textarea that has the 'required' attribute.
    // It captures the label attributes (group 1) and label text (group 2).
    // Because parsing HTML with regex is imperfect, this regex targets common Laravel/Bootstrap patterns.
    
    // Pattern: <label ...> ... </label> whitespace <input/select/textarea ... required ...>
    const regex = /(<label[^>]*>)([\s\S]*?)(<\/label>)([\s\S]{0,150}?<(?:input|select|textarea)[^>]*?\brequired\b[^>]*>)/gi;

    content = content.replace(regex, (match, p1, p2, p3, p4) => {
        // Clean up existing hardcoded asterisks like ' *' or ' * ' or ' *</label>'
        let text = p2.replace(/\s*\*\s*$/, '').trim();
        
        // If it doesn't already have the red asterisk span
        if (!text.includes('<span class="text-danger">*</span>')) {
            text = text + ' <span class="text-danger">*</span>';
        }
        
        return p1 + text + p3 + p4;
    });

    fs.writeFileSync(file, content, 'utf8');
    console.log(`Processed ${file}`);
});
