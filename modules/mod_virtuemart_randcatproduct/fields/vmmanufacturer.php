<?php
// Защита от прямого доступа к файлу
defined('_JEXEC') or die('(@)|(@)');
 
// Подключение требуемых файлов
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');
 
/**
 * Создаем класс. Fieldname - имя типа
 */
class JFormFieldvmmanufacturer extends JFormFieldList
{
    /**
     * @var $type    Имя типа
     */
    protected $type = 'vmmanufacturer';
    /**
     * Метод, заменяющий родительский JFormFieldList::getOptions()
     *
     * @return    $options;
     */
    protected function getOptions()
    {
        // Получаем объект базы данных.
        $db = JFactory::getDBO();
 
        // Конструируем SQL запрос.
        $query = $db->getQuery(true);
		$query = "SELECT virtuemart_manufacturer_id, mf_name FROM #__virtuemart_manufacturers_ru_ru";
        $db->setQuery($query);
        $messages = $db->loadObjectList();
 
        // Массив JHtml опций.
        $options = array();
        if ($messages)
        {
			$options[] = JHtml::_('select.option', 0, 'Все производители');
            foreach($messages as $message) 
            {
                $options[] = JHtml::_('select.option', $message->virtuemart_manufacturer_id, $message->mf_name);
            }
        }
        $options = array_merge(parent::getOptions(), $options);
 
        return $options;
    }
}