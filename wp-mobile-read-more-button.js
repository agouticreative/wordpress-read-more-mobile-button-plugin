readMoreBuffer = {

    bufferZoneHeight: 200,
    maximumViewportWidth: 768,
    viewportMultiples: 2,
    buttonText: 'Read More',
    html: '\
        <div class="readmore-wrapper">\
                <div class="readmore-buffer"></div>\
                <div class="readmore-button"></div>\
        </div>\
    ',
    optionalFields: ['buttonText', 'viewportMultiples'],

    exec: function() {
        this.mergeOptions()
        if (
            this.definePageConstants() &&
            this.isContentLongEnough() &&
            this.isPageWidthValid()
        ) {
            this.renderBufferZone();
        }
    },

    mergeOptions: function() {
        console.log(readMoreOptions);
        if(!readMoreOptions) return;
        for(optionalFieldKey in this.optionalFields) {
            optionalField = this.optionalFields[optionalFieldKey]
            this[optionalField] = readMoreOptions[optionalField] || this[optionalField];
        }
    },

    definePageConstants: function() {
        this.$entryContent = jQuery('article.post');
        if(this.$entryContent.length == 0) return false;
        this.$entryFooter = jQuery('.entry-footer');
        this.contentOffsetTop = this.$entryContent.offset().top;
        this.contentOffsetBottom = this.contentOffsetTop + this.$entryContent.height();
        this.contentHeight = this.$entryContent.height();
        this.viewportHeight = jQuery(window).height();
        this.viewportWidth = jQuery(window).width();
        this.bufferTopOffset = this.viewportHeight * this.viewportMultiples - this.bufferZoneHeight;
        this.bufferBottomOffset = this.bufferTopOffset + this.bufferZoneHeight;
        return true;
    },

    isContentLongEnough: function() {
        return this.contentOffsetBottom > this.bufferTopOffset
    },

    isPageWidthValid: function() {
        return this.viewportWidth <= this.maximumViewportWidth;
    },

    getTopOfBufferPos: function() {
        return this.viewportHeight - this.bufferZoneHeight;
    },

    getNewContentHeight: function() {
        return this.bufferBottomOffset -
            this.contentOffsetTop
    },

    setContentHeight: function() {
        newHeight = this.getNewContentHeight();
        this.$entryContent.height(newHeight);
    },

    renderBufferZone: function () {
        this.insertButtonHtml();
        this.$entryContent.addClass('readmore-truncated');
        this.$entryFooter.css('display', 'none');
        this.setContentHeight();
        this.setClickEvent();
    },

    insertButtonHtml: function () {
        this.$entryContent.after(this.html);
        this.setReadMoreButtonEls();
        this.$readMoreButton.text(this.buttonText);
    },

    setReadMoreButtonEls: function() {
        this.$readMoreWrapper = jQuery('.readmore-wrapper');
        this.$readMoreButton = this.$readMoreWrapper.find('.readmore-button');
    },

    setClickEvent: function() {
        this.$readMoreButton.on(
            'click',
            this.viewFullArticle.bind(this)
        );
    },

    viewFullArticle: function() {
        jQuery('.readmore-wrapper').remove();
        this.$entryContent.removeClass('readmore-truncated');
        this.$entryContent.css('height', 'auto');
        this.$entryFooter.css('display', 'block');
    },
}

readMoreBuffer.exec();

