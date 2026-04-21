FROM php:8.2-apache

# تمكين إعادة كتابة المسارات
RUN a2enmod rewrite

# تعيين المجلد الذي سيخدم منه Apache
WORKDIR /var/www/html

# نسخ جميع ملفات البوت إلى المجلد الصحيح
COPY . /var/www/html/

# تعيين الصلاحيات الصحيحة
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# التأكد من أن index.php هو الملف الافتراضي
RUN echo "DirectoryIndex index.php" > /etc/apache2/conf-available/directory-index.conf && \
    a2enconf directory-index

# تعيين ServerName لتجنب تحذيرات Apache
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# فتح المنفذ 80
EXPOSE 80

# تشغيل Apache في المقدمة
CMD ["apache2-foreground"]
