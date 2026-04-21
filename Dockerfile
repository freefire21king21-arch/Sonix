FROM php:8.2-apache

# تمكين mod_rewrite
RUN a2enmod rewrite

# نسخ جميع ملفات البوت إلى المجلد الصحيح
COPY . /var/www/html/

# تعيين الصلاحيات
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# التأكد من أن index.php هو الملف الافتراضي
RUN echo "DirectoryIndex index.php" > /etc/apache2/conf-available/directory-index.conf && \
    a2enconf directory-index

# فتح المنفذ 80
EXPOSE 80
