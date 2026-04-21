FROM php:8.2-apache

# تمكين mod_rewrite (ضروري لعمل .htaccess)
RUN a2enmod rewrite

# إنشاء المجلدات المطلوبة ومنح الصلاحيات
RUN mkdir -p /var/www/html/data /var/www/html/EMIL /var/www/html/EMILS /var/www/html/BUY /var/www/html/assignment
RUN chmod -R 777 /var/www/html/data /var/www/html/EMIL /var/www/html/EMILS /var/www/html/BUY /var/www/html/assignment

# نسخ جميع ملفات البوت إلى المجلد الرئيسي
COPY . /var/www/html/

# تعيين الصلاحيات لمالك الخادم
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# التأكد من أن index.php هو الملف الافتراضي
RUN echo "DirectoryIndex index.php" > /etc/apache2/conf-available/directory-index.conf && \
    a2enconf directory-index

# فتح المنفذ 80
EXPOSE 80
