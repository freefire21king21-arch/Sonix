FROM php:8.2-apache

# تمكين وحدة mod_rewrite في Apache
RUN a2enmod rewrite

# نسخ ملفات البوت إلى المجلد الافتراضي لـ Apache
COPY . /var/www/html/

# تعيين الصلاحيات الصحيحة للمجلدات والملفات
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# التأكد من أن index.php هو الملف الافتراضي الذي يتم تحميله عند زيارة المجلد
RUN echo "DirectoryIndex index.php" > /etc/apache2/conf-available/directory-index.conf && \
    a2enconf directory-index

# تجاوز تكوين Apache الافتراضي لضمان أن DocumentRoot يشير إلى المجلد الصحيح
# هذا الأمر يعدل ملف 000-default.conf لجعل DocumentRoot هو /var/www/html
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html|g' /etc/apache2/sites-available/000-default.conf && \
    sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html|g' /etc/apache2/sites-available/default-ssl.conf

# منع ظهور تحذير 'Could not reliably determine the server's fully qualified domain name'
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# فتح المنفذ 80
EXPOSE 80

# بدء تشغيل Apache في المقدمة (وهي الطريقة الموصى بها للحاويات)
CMD ["apache2-foreground"]
