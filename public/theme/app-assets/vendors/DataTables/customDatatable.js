function pdfFonts(CairoRegular, CairoBold) {
    pdfMake.fonts = {
        Cairo: {
            normal: CairoRegular,
            bold: CairoBold,
            italics: CairoRegular,
            bolditalics: CairoBold
        }
    };
}

function pdfFooter() {
    var currentdate = new Date();
    var hours = currentdate.getHours();
    var ampm = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12 || 12; // Convert 0 to 12 for midnight
    var datetime =
        "Gesture ERP | Exported on: " +
        currentdate.getDate() +
        "/" +
        (currentdate.getMonth() + 1) +
        "/" +
        currentdate.getFullYear() +
        " @ " +
        hours +
        ":" +
        currentdate.getMinutes() +
        ":" +
        currentdate.getSeconds() +
        " " +
        ampm;

    return datetime;
}

function isEnglish(content) {
    var nonEnglishRegex = /[^a-zA-Z0-9\s!@#$%^&*()_+{}\[\]:;<>,.?~\\/-]/;
    return !nonEnglishRegex.test(content);
}


pdfFonts(CairoRegular, CairoBold);

function customizePdf(doc, waterMark) {
    if (isEnglish(waterMark)) {
        finalWaterMark = waterMark;
    } else {
        finalWaterMark = waterMark.split(' ').reverse().map(word => ' ' + word + ' ').join('');
    }
    doc.content[2].margin = [100, 0, 100, 0];
    doc.content[2].layout = 'fullwidth';
    doc.watermark = {
        text: finalWaterMark,
        color: 'blue',
        opacity: 0.1
    };
    doc.pageSize = 'A4';
    doc.footer = pdfFooter();
    doc.defaultStyle.font = 'Cairo';
    doc.styles.message.alignment = "right";
    doc.styles.tableBodyEven.alignment = "center";
    doc.styles.tableBodyOdd.alignment = "center";
    doc.styles.tableFooter.alignment = "center";
    doc.styles.tableHeader.alignment = "center";
    if (!isEnglish(doc.content[0]['text'])) {
        doc.content[0]['text'] = doc.content[0]['text'].split(' ').reverse().join(' ');
    }
    if (!isEnglish(doc.content[1]['text'])) {
        doc.content[1]['text'] = doc.content[1]['text'].split(' ').reverse().map(word => ' ' + word + ' ').join('');
    }
    for (var i = 0; i < doc.content[2].table.body.length; i++) {
        for (var j = 0; j < doc.content[2].table.body[i].length; j++) {
            var text = doc.content[2].table.body[i][j]['text'];
            if (!isEnglish(text)) {
                var words = text.split(' ').reverse();
                var newText = words.map(word => ' ' + word + ' ').join('');
                doc.content[2].table.body[i][j]['text'] = newText;
            }
        }
    }
}


function generateColumnsArray(numItems) {
    var columns = [];

    // Generate the array with numbers from 0 to numItems-1
    for (var i = 0; i < numItems; i++) {
        columns.push(i);
    }

    return columns;
}

function generateColumnsArrayReversed(numItems) {
    var columns = [];

    // Generate the array with numbers from numItems-1 down to 0
    for (var i = numItems - 1; i >= 0; i--) {
        columns.push(i);
    }

    return columns;
}

function createDataTableButtons(title, numItems) {
    var buttons = [
        {
            extend: 'excelHtml5',
            text: 'حفظ كملف EXCEL',
            messageTop: 'قائمة ' + title,
            exportOptions: {
                columns: generateColumnsArrayReversed(numItems)
            }
        },
        {
            extend: 'pdfHtml5',
            text: 'حفظ كملف PDF',
            messageTop: 'قائمة ' + title,
            download: 'open',
            exportOptions: {
                columns: generateColumnsArrayReversed(numItems),
                orthogonal: "PDF"
            },
            customize: function (doc) {
                customizePdf(doc, waterMark);
            },
        },
        {
            extend: 'print',
            text: 'طباعة',
            messageTop: 'قائمة ' + title,
            exportOptions: {
                columns: generateColumnsArray(numItems)
            }
        }
    ];

    return buttons;
}


function getDatatablesLanguageConfig() {
    return {
        "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/ar.json"
    };
}
